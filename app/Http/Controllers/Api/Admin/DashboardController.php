<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\MenuOrderResource;
use App\Models\ContactInquiry;
use App\Models\MenuItem;
use App\Models\MenuOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $stats = [
            'total_orders' => MenuOrder::count(),
            'total_revenue' => (float) MenuOrder::query()
                ->where('status', 'completed')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->sum('total_amount'),
            'weekly_inquiries' => ContactInquiry::where('created_at', '>=', now()->subDays(7))->count(),
            'total_menu_items' => MenuItem::count(),
        ];

        $recentOrders = MenuOrder::query()
            ->withCount('items')
            ->latest()
            ->paginate(10, ['*'], 'recent_orders_page');

        return response()->json([
            'data' => [
                'stats' => $stats,
                'recent_orders' => [
                    'data' => MenuOrderResource::collection($recentOrders->getCollection())->resolve(),
                    'meta' => [
                        'current_page' => $recentOrders->currentPage(),
                        'last_page' => $recentOrders->lastPage(),
                        'per_page' => $recentOrders->perPage(),
                        'total' => $recentOrders->total(),
                        'from' => $recentOrders->firstItem(),
                        'to' => $recentOrders->lastItem(),
                    ],
                ],
            ],
        ]);
    }
}
