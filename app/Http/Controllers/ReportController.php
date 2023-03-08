<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        // $therapist = Therapist::get();
        // $order = Order::get();
        // $AmountOfSalary = $therapist->map(function ($therapist) use ($order) {
        //     $amountOfOrder = $order
        //         ->where('therapist_id', $therapist->id)
        //         ->whereMonth('created_at', Carbon::now()->month)
        //         ->count();
        //     $salary = $amountOfOrder * $therapist->commision;
        //     return [
        //         'therapist_name' => $therapist->name,
        //         'order_amount' => $amountOfOrder,
        //         'salary' => $salary,
        //     ];
        // });

        $terapis = Therapist::all();
        $bulan = Carbon::now();
        if ($request->input('bulan')) {
            $bulan = Carbon::createFromFormat('Y-m', $request->input('bulan'));
        }
        $data = [];

        foreach ($terapis as $t) {
            $jumlah_orderan = Order::where('therapist_id', $t->id)
                ->whereMonth('created_at', $bulan->month)
                ->whereYear('created_at', $bulan->year)
                ->count();

            // $gaji_pokok = $t->commision;
            $bonus = $jumlah_orderan * $t->commision;
            $data[] = [
                'therapist_name' => $t->name,
                'order_amount' => $jumlah_orderan,
                'salary' => $bonus,
            ];
        }

        $total_salary = array_reduce($data, function ($sum, $item) {
            return $sum + $item['salary'];
        });
        return view('dashboard.report.index', [
            'title' => 'Report',
            'days' => $dateNow->get(),
            'totalADays' => $dateNow->sum('summary'),
            'salarys' => $data,
            'Summary' => $total_salary,
            'month_salary' => $bulan,
        ]);
    }

    public function printSalary(Request $request)
    {
        $dateNow = Order::whereDate('created_at', '=', Date('Y-m-d'));
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        // if (request('start_date') && request('end_date')) {
        //     $dateNow = Order::whereBetween('created_at', [
        //         request('start_date'),
        //         request('end_date'),
        //     ]);
        // }
        $dateNow = Order::whereBetween('created_at', [$start_date, $end_date]);

        $terapis = Therapist::all();
        $bulan = Carbon::now();
        if ($request->input('bulan')) {
            $bulan = Carbon::createFromFormat('Y-m', $request->input('bulan'));
        }
        $data = [];

        foreach ($terapis as $t) {
            $jumlah_orderan = Order::where('therapist_id', $t->id)
                ->whereMonth('created_at', $bulan->month)
                ->whereYear('created_at', $bulan->year)
                ->count();

            // $gaji_pokok = $t->commision;
            $bonus = $jumlah_orderan * $t->commision;
            $data[] = [
                'therapist_name' => $t->name,
                'order_amount' => $jumlah_orderan,
                'salary' => $bonus,
            ];
        }

        $total_salary = array_reduce($data, function ($sum, $item) {
            return $sum + $item['salary'];
        });

        if (request('start_month')) {
            // $dateNow = Order::whereBetween('created_at', [
            //     request('start_date'),
            //     request('end_date'),
            // ]);
            $terapis = Therapist::all();
            $data = [];

            foreach ($terapis as $t) {
                $jumlah_orderan = Order::where('therapist_id', $t->id)
                    ->where('created_at', $request('start_month'))
                    ->count();

                // $gaji_pokok = $t->commision;
                $bonus = $jumlah_orderan * $t->commision;
                $data[] = [
                    'therapist_name' => $t->name,
                    'order_amount' => $jumlah_orderan,
                    'salary' => $bonus,
                ];
            }
        }
        // dd(Carbon::now()->month);
        return view('dashboard.pdf.salary', [
            'title' => 'Report',
            'days' => $dateNow,
            'totalADays' => $dateNow->sum('summary'),
            'salarys' => $data,
            'Summary' => $total_salary,
            'month_salary' => $bulan,
        ]);
    }
}
