<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $query = Order::whereBetween('created_at', [$start, $end])->get();
        // dd($query);
        return view('dashboard.report.index', [
            'title' => 'Report',
            'days' => $query,
            'totalADays' => Order::wherebetween('created_at', [
                $start,
                $end,
            ])->sum('summary'),
            'weeks' => Order::select(
                DB::raw(
                    'WEEK(created_at) as week_number, COUNT(*) as total_sales, SUM(summary) as summary'
                )
            )
                ->groupBy('week_number')
                ->get(),
        ]);
    }
}
