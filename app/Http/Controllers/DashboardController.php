<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
            $summarys[] = $order->summary;
        }

        $favorite_services = DB::table('orders')
            ->select(
                DB::raw('YEARWEEK(orders.created_at) as week_number'),
                'services.id',
                'services.massage',
                DB::raw('COUNT(*) as total')
            )
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->groupBy('week_number', 'services.id', 'services.massage')
            ->orderBy('week_number', 'asc')
            ->orderBy('total', 'desc')
            ->get();

        return view('dashboard.dash.index', [
            'title' => 'Dashboard',
            'orders' => Order::whereDate(
                'created_at',
                '=',
                date('Y-m-d')
            )->get(),
            'order_on' => Order::whereDate('created_at', '=', date('Y-m-d'))
                ->where('status', '=', 'pending')
                ->get(),
            'order_on_going' => Order::whereDate(
                'created_at',
                '=',
                date('Y-m-d')
            )
                ->where('status', '=', 'on going')
                ->get(),
            'therapists' => Therapist::where('status', '=', 3)->get(),
            'therapists_total' => Therapist::where('status', '>', 1)->get(),

            'months' => $months,
            'counts' => $counts,
            'summarys' => $summarys,
            'favorites' => $favorite_services,
            'services' => Service::all(),
        ]);
    }
}
