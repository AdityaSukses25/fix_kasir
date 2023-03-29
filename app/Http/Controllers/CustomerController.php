<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
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
        $terapis = Therapist::all();
        $bulan = Carbon::now();
        if ($request->input('bulan')) {
            $bulan = Carbon::createFromFormat('Y-m', $request->input('bulan'));
        }
        $data = [];

        foreach ($terapis as $t) {
            $jumlah_orderan = Order::with('therapist')
                ->where('therapist_id', $t->id)
                ->whereMonth('created_at', $bulan->month)
                ->whereYear('created_at', $bulan->year)
                ->get();

            // $gaji_pokok = $t->commision;
            $bonus = $jumlah_orderan->count() * $t->commision;
            $order_details = [];
            foreach ($jumlah_orderan as $order) {
                $order_details[] = [
                    'order_id' => $order->id,
                    'order_date' => $order->created_at->format('Y-m-d'),
                    'customer_name' => $order->cust_name,
                    'reception_name' => $order->reception->name,
                    'service' => $order->service->massage,
                    'time' => $order->time,
                    'jam' => $order->start_service,
                ];
            }

            $data[] = [
                'therapist_name' => $t->name,
                'therapist_id' => $t->id,
                'order_amount' => $jumlah_orderan->count(),
                'salary' => $bonus,
                'order_details' => $order_details,
            ];
        }

        $total_salary = array_reduce($data, function ($sum, $item) {
            return $sum + $item['salary'];
        });
        $orderan = Order::where('therapist_id', 1)
            ->whereMonth('created_at', $bulan->month)
            ->whereYear('created_at', $bulan->year)
            ->get();
        return view('dashboard.transaction.index', [
            'title' => 'Transaction Record',
            'days' => $dateNow->get(),
            'totalADays' => $dateNow->sum('summary'),
            'salarys' => $data,
            'Summary' => $total_salary,
            'month_salary' => $bulan,
        ]);
    }
}
