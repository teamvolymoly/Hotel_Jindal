<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\MenuOrderResource;
use App\Models\ContactInquiry;
use App\Models\MenuItem;
use App\Models\MenuOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __invoke(): JsonResponse
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
            ->take(6)
            ->get();

        return response()->json([
            'data' => [
                'stats' => $stats,
                'recent_orders' => MenuOrderResource::collection($recentOrders)->resolve(),
            ],
        ]);
    }
}
