<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuOrderStoreRequest;
use App\Models\MenuItem;
use App\Models\MenuOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MenuOrderController extends Controller
{
    public function store(MenuOrderStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $requestedItems = collect($validated['items']);
        $menuItems = MenuItem::query()
            ->whereIn('id', $requestedItems->pluck('menu_item_id')->all())
            ->where('is_available', true)
            ->get()
            ->keyBy('id');

        if ($menuItems->count() !== $requestedItems->count()) {
            throw ValidationException::withMessages([
                'items' => 'One or more menu items are unavailable.',
            ]);
        }

        $order = DB::transaction(function () use ($validated, $requestedItems, $menuItems) {
            $totalAmount = 0;

            $order = MenuOrder::create([
                'guest_name' => $validated['guest']['name'],
                'room_no' => $validated['guest']['room_no'],
                'phone' => $validated['guest']['phone'],
                'status' => 'pending',
                'total_amount' => 0,
            ]);

            foreach ($requestedItems as $requestedItem) {
                $menuItem = $menuItems->get($requestedItem['menu_item_id']);
                $quantity = (int) $requestedItem['quantity'];
                $itemPrice = (float) $menuItem->price;
                $lineTotal = $itemPrice * $quantity;
                $totalAmount += $lineTotal;

                $order->items()->create([
                    'menu_item_id' => $menuItem->id,
                    'item_name' => $menuItem->name,
                    'item_price' => $itemPrice,
                    'quantity' => $quantity,
                    'line_total' => $lineTotal,
                ]);
            }

            $order->update([
                'total_amount' => $totalAmount,
            ]);

            return $order->load('items');
        });

        return response()->json([
            'message' => 'Order placed successfully.',
            'data' => [
                'order_id' => $order->id,
                'status' => $order->status,
                'total_amount' => (float) $order->total_amount,
            ],
        ], 201);
    }
}
