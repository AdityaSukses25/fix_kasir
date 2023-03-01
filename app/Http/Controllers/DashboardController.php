<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Therapist;
use Illuminate\Support\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DashboardController extends Controller
{
    public function index()
    {
        // Data bulan dan jumlah order
        $orders = Order::selectRaw(
            'MONTH(created_at) as month, COUNT(*) as count, SUM(summary) as summary'
        )
            ->groupBy('month')
            ->get();
        $months = [];
        $counts = [];
        $summarys = [];

        foreach ($orders as $order) {
            $months[] = $order->month;
            $counts[] = $order->count;
            $summary[] = $order->summary;
        }

        return view('dashboard.dash.index', [
            'title' => 'Dashboard',
            'orders' => Order::whereDate(
                'created_at',
                '=',
                date('Y-m-d')
            )->get(),
            'therapists' => Therapist::where('status', 1)->get(),

            'months' => $months,
            'counts' => $counts,
            'summarys' => $summary,
        ]);
    }
}
