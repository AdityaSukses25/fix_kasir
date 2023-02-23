<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('dashboard.report.index', [
            'title' => 'Report',
            'days' => Order::whereDate('created_at', '=', Date('Y-m-d'))->get(),
            'totalADays' => Order::whereDate(
                'created_at',
                '=',
                Date('Y-m-d')
            )->sum('summary'),
            'weeks' => Order::select(
                DB::raw(
                    'WEEK(created_at) as week_number, COUNT(*) as total_sales, SUM(summary) as summary'
                )
            )
                ->groupBy('week_number')
                ->get(),
        ]);
    }

    public function searchDate(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $query = DB::table('orders')
            ->select()
            ->whereBetween('created_at', [$start, $end])
            ->get();
        return response()->json(['query' => $query]);
        // return view('dashboard.report.index', [
        //     'days' => $query,
        //     'title' => 'Report',
        //     'totalADays' => Order::whereDate(
        //         'created_at',
        //         '=',
        //         Date('Y-m-d')
        //     )->sum('summary'),
        // ]);
    }
}
