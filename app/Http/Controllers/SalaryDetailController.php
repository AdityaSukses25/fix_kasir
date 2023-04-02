<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Place;
use App\Models\Gender;
use App\Models\Service;
use App\Models\Discount;
use App\Models\ExtraTime;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SalaryDetailController extends Controller
{
    public function index(Request $request, Therapist $therapist)
    {
        $terapis = Therapist::where('id', $therapist->id)
            ->where('status', '>', 1)
            ->get();
        $bulan = Carbon::now();
        if ($request->input('bulan')) {
            $bulan = Carbon::createFromFormat('Y-m', $request->input('bulan'));
        }
        $data = [];

        foreach ($terapis as $t) {
            $jumlah_orderan = Order::with('therapist')
                ->where('therapist_id', $t->id)
                ->where('status', '=', 'finish')
                ->whereMonth('created_at', $bulan->month)
                ->whereYear('created_at', $bulan->year)
                ->get();

            $gaji_pokok = $t->commision;
            $gaji_extra = $gaji_pokok / 60;
            $bonus = 0;
            $order_details = [];
            foreach ($jumlah_orderan as $order) {
                $extra_time = ExtraTime::where('order_id', $order->id)->first();
                $order_bonus = 0;
                if ($extra_time) {
                    $order_bonus =
                        $extra_time->extra_time * $gaji_extra + $gaji_pokok;
                }
                $bonus = $order_bonus;
                $order_details[] = [
                    'order_id' => $order->id,
                    'order_date' => $order->created_at->format('Y-m-d'),
                    'order_time' => $order->start_service,
                    'customer_name' => $order->cust_name,
                    'reception_name' => $order->reception->name,
                    'service' => $order->service->massage,
                    'time_duration' => $order->time,
                    'time' => $order->start_service,
                    'extra_time' => $extra_time
                        ? $extra_time->extra_time
                        : null,
                    'order_bonus' => $bonus,
                    'service_extra' => $extra_time->service->massage,
                ];
            }
            $total_gaji = $gaji_pokok * $jumlah_orderan->count();
            $data[] = [
                'therapist_name' => $t->name,
                'therapist_id' => $t->id,
                'therapist_commision' => $t->commision,
                'order_amount' => $jumlah_orderan->count(),
                'gaji_pokok' => $gaji_pokok,
                'total_gaji' => $total_gaji,
                'bonus' => $bonus,
                'total_salary' => $total_gaji + $bonus,
                'order_details' => $order_details,
            ];
        }
        $total_salary = array_reduce($order_details, function ($sum, $item) {
            return $sum + $item['order_bonus'];
        });
        // dd($total_salary);
        return \view('dashboard.salary-detail.index', [
            'title' => 'Report',
            'salary' => $data,
            'Summary' => $total_salary,
        ]);
    }

    public function printSalaryDetail(Request $request, Therapist $therapist)
    {
        $terapis = Therapist::where('id', $therapist->id)
            ->where('status', '>', 1)
            ->get();
        $bulan = Carbon::now();
        if ($request->input('bulan')) {
            $bulan = Carbon::createFromFormat('Y-m', $request->input('bulan'));
        }
        $data = [];

        foreach ($terapis as $t) {
            $jumlah_orderan = Order::with('therapist')
                ->where('therapist_id', $t->id)
                ->where('status', '=', 'finish')
                ->whereMonth('created_at', $bulan->month)
                ->whereYear('created_at', $bulan->year)
                ->get();

            $gaji_pokok = $t->commision;
            $gaji_extra = $gaji_pokok / 60;
            $bonus = 0;
            $order_details = [];
            foreach ($jumlah_orderan as $order) {
                $extra_time = ExtraTime::where('order_id', $order->id)->first();
                $order_bonus = 0;
                if ($extra_time) {
                    $order_bonus =
                        $extra_time->extra_time * $gaji_extra + $gaji_pokok;
                }
                $bonus = $order_bonus;
                $order_details[] = [
                    'order_id' => $order->id,
                    'order_date' => $order->created_at->format('Y-m-d'),
                    'order_time' => $order->start_service,
                    'customer_name' => $order->cust_name,
                    'reception_name' => $order->reception->name,
                    'service' => $order->service->massage,
                    'time_duration' => $order->time,
                    'time' => $order->start_service,
                    'extra_time' => $extra_time
                        ? $extra_time->extra_time
                        : null,
                    'order_bonus' => $bonus,
                    'service_extra' => $extra_time->service->massage,
                ];
            }
            $total_gaji = $gaji_pokok * $jumlah_orderan->count();
            $data[] = [
                'therapist_name' => $t->name,
                'therapist_id' => $t->id,
                'therapist_commision' => $t->commision,
                'order_amount' => $jumlah_orderan->count(),
                'gaji_pokok' => $gaji_pokok,
                'total_gaji' => $total_gaji,
                'bonus' => $bonus,
                'total_salary' => $total_gaji + $bonus,
                'order_details' => $order_details,
            ];
        }
        $total_salary = array_reduce($order_details, function ($sum, $item) {
            return $sum + $item['order_bonus'];
        });
        // dd($data);
        return \view('dashboard.pdf.salary-detail', [
            'title' => 'Report',
            'salary' => $data,
            'Summary' => $total_salary,
            'Now' => Carbon::now()->setTimezone('Asia/Makassar'),
            'month_salary' => $bulan,
        ]);
    }
}
