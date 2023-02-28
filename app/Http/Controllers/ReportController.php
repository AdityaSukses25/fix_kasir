<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $dateNow = Order::whereDate('created_at', '=', Date('Y-m-d'));
        if (request('start_date') && request('end_date')) {
            $dateNow = Order::whereBetween('created_at', [
                request('start_date'),
                request('end_date'),
            ]);
        }
        // $salary = Therapist::join(
        //     'orders',
        //     'therapists.id',
        //     '=',
        //     'orders.therapist_id'
        // )
        //     ->select('therapists.*', 'orders.summary')
        //     ->sum('');
        $service_total = Order::where('therapist_id', '=', 1)->count();
        $commision = Therapist::where('id', 1)->sum('commision');
        $total1 = $service_total * $commision;
        $service_total1 = Order::where('therapist_id', '=', 2)->count();
        $commision1 = Therapist::where('id', 2)->sum('commision');
        $total2 = $service_total1 * $commision1;
        $service_total2 = Order::where('therapist_id', '=', 3)->count();
        $commision2 = Therapist::where('id', 3)->sum('commision');
        $total3 = $service_total2 * $commision2;
        $total = $total1 + $total2 + $total3;
        // $salary = $commision;
        return view('dashboard.report.index', [
            'title' => 'Report',
            'days' => $dateNow->get(),
            'totalADays' => $dateNow->sum('summary'),
            'salarys' => Therapist::get(),
            'service_total' => $service_total,
            'gajih' => $commision * $service_total,
            'service_total1' => $service_total1,
            'gajih1' => $commision1 * $service_total1,
            'service_total2' => $service_total2,
            'gajih2' => $commision2 * $service_total2,
            'total' => $total,
        ]);
    }
}
