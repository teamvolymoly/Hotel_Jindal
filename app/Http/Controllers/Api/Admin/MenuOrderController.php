<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuOrderStatusRequest;
use App\Http\Resources\Admin\MenuOrderResource;
use App\Models\MenuOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuOrderController extends Controller
{
    public function index(Request $request): mixed
    {
        $orders = MenuOrder::query()
            ->withCount('items')
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = trim((string) $request->string('q'));
                $query->where(function ($innerQuery) use ($term) {
                    $innerQuery->where('guest_name', 'like', '%' . $term . '%')
                        ->orWhere('room_no', 'like', '%' . $term . '%')
                        ->orWhere('phone', 'like', '%' . $term . '%')
                        ->orWhere('id', $term);
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->latest()
            ->paginate(10);

        return MenuOrderResource::collection($orders);
    }

    public function show(MenuOrder $menuOrder): JsonResponse
    {
        return response()->json([
            'data' => (new MenuOrderResource($menuOrder->load('items')))->resolve(),
        ]);
    }

    public function updateStatus(MenuOrderStatusRequest $request, MenuOrder $menuOrder): JsonResponse
    {
        $menuOrder->update([
            'status' => $request->validated()['status'],
        ]);

        return response()->json([
            'message' => 'Order status updated successfully.',
            'data' => (new MenuOrderResource($menuOrder->fresh()->load('items')))->resolve(),
        ]);
    }

    public function latest(): JsonResponse
    {
        $latestOrder = MenuOrder::latest()->first();

        return response()->json([
            'data' => $latestOrder ? (new MenuOrderResource($latestOrder))->resolve() : null,
        ]);
    }
}
