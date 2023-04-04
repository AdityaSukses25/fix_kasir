<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\ExtraTime;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // sales
        if (request('start_date') && request('end_date')) {
            $extra_time = DB::table('orders')
                ->join('extra_times', 'orders.id', '=', 'extra_times.order_id')
                ->whereBetween('orders.created_at', [
                    request('start_date'),
                    request('end_date'),
                ])
                ->join(
                    'therapists',
                    'orders.therapist_id',
                    '=',
                    'therapists.id'
                )
                ->join('discounts', 'orders.discount_id', '=', 'discounts.id')
                ->join('services', 'orders.service_id', '=', 'services.id')
                ->join('places', 'orders.place_id', '=', 'places.id')

                ->join(
                    'services as services_extra',
                    'extra_times.service_id',
                    '=',
                    'services_extra.id'
                )
                ->select(
                    'orders.*',
                    'therapists.nickname as nickname',
                    'therapists.name as name',
                    'therapists.id as therapistId',
                    'extra_times.start_extra_time',
                    'extra_times.id as extraId',
                    'extra_times.end_extra_time',
                    'extra_times.extra_time',
                    'extra_times.price_extra_time as priceExtra',
                    'services.massage as massage',
                    'places.place as place',
                    'services_extra.massage as massageExtra',
                    'discounts.discount as discount',
                    'extra_times.summary_extra_time'
                )
                ->orderBy('id', 'desc');
        } else {
            $extra_time = DB::table('orders')
                ->join('extra_times', 'orders.id', '=', 'extra_times.order_id')
                ->join(
                    'therapists',
                    'orders.therapist_id',
                    '=',
                    'therapists.id'
                )
                ->join('services', 'orders.service_id', '=', 'services.id')
                ->join('places', 'orders.place_id', '=', 'places.id')
                ->join('discounts', 'orders.discount_id', '=', 'discounts.id')
                ->join(
                    'services as services_extra',
                    'extra_times.service_id',
                    '=',
                    'services_extra.id'
                )
                ->whereDate('orders.created_at', date('Y-m-d'))
                ->select(
                    'orders.*',
                    // 'orders.created_at.format("Y-m-d") as tanggal',
                    'therapists.nickname as nickname',
                    'therapists.name as name',
                    'therapists.id as therapistId',
                    'discounts.discount as discount',
                    'extra_times.start_extra_time',
                    'extra_times.id as extraId',
                    'extra_times.end_extra_time',
                    'extra_times.extra_time',
                    'extra_times.summary_extra_time',
                    'extra_times.price_extra_time as priceExtra',
                    'services.massage as massage',
                    'services_extra.massage as massageExtra',
                    'places.place as place'
                )
                ->orderBy('id', 'desc');
        }
        // end sales

        // salary
        $terapis = Therapist::where('status', '>', 1)
            ->orderBy('name')
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
                $extra_time_salary = ExtraTime::where(
                    'order_id',
                    $order->id
                )->first();
                $order_bonus = 0;
                if ($extra_time_salary) {
                    $order_bonus =
                        $extra_time_salary->extra_time * $gaji_extra +
                        $gaji_pokok;
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
                    'extra_time' => $extra_time_salary
                        ? $extra_time_salary->extra_time
                        : null,
                    'order_bonus' => $bonus,
                    'service_extra' => $extra_time_salary->service->massage,
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

        return view('dashboard.report.index', [
            'title' => 'Report',
            'days' => $extra_time->get(),
            'totalADays' => $extra_time->sum('summary_extra_time'),
            'salarys' => $data,
            'Summary' => $total_salary,
            'month_salary' => $bulan,
            // 'details' => $,
        ]);
    }

    public function printSalary(Request $request)
    {
        $dateNow = Order::whereDate('created_at', '=', Date('Y-m-d'));
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $dateNow = Order::whereBetween('created_at', [$start_date, $end_date]);

        // salary
        $terapis = Therapist::where('status', '>', 1)
            ->orderBy('name')
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
                $extra_time_salary = ExtraTime::where(
                    'order_id',
                    $order->id
                )->first();
                $order_bonus = 0;
                if ($extra_time_salary) {
                    $order_bonus =
                        $extra_time_salary->extra_time * $gaji_extra +
                        $gaji_pokok;
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
                    'extra_time' => $extra_time_salary
                        ? $extra_time_salary->extra_time
                        : null,
                    'order_bonus' => $bonus,
                    'service_extra' => $extra_time_salary->service->massage,
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
        return view('dashboard.pdf.salary', [
            'title' => 'Report',
            'days' => $dateNow,
            'totalADays' => $dateNow->sum('summary'),
            'salarys' => $data,
            'Summary' => $total_salary,
            'month_salary' => $bulan,
            'Now' => Carbon::now()->setTimezone('Asia/Makassar'),
        ]);
    }
}
