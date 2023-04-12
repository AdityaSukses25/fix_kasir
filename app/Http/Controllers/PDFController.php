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

class PDFController extends Controller
{
    public function index(Request $request)
    {
        $dateNow = Order::whereDate('created_at', '=', Date('Y-m-d'));
        if (request('start_sales') && request('end_sales')) {
            $dateNow = Order::whereBetween('created_at', [
                request('start_sales'),
                request('end_sales'),
            ]);
        }

        if (request('start_sales') && request('end_sales')) {
            $extra_time = DB::table('orders')
                ->join('extra_times', 'orders.id', '=', 'extra_times.order_id')
                ->whereBetween('orders.created_at', [
                    request('start_sales'),
                    request('end_sales'),
                ])
                ->join(
                    'therapists',
                    'orders.therapist_id',
                    '=',
                    'therapists.id'
                )
                // ->join('discounts', 'orders.discount_id', '=', 'discounts.id')
                ->join('services', 'orders.service_id', '=', 'services.id')
                ->join('places', 'orders.place_id', '=', 'places.id')

                ->join(
                    'services as services_extra',
                    'extra_times.service_id',
                    '=',
                    'services_extra.id'
                )
                ->where('orders.status', '!=', 'pending')
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
                    // 'discounts.discount as discount',
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
                // ->join('discounts', 'orders.discount_id', '=', 'discounts.id')
                ->join(
                    'services as services_extra',
                    'extra_times.service_id',
                    '=',
                    'services_extra.id'
                )
                ->whereDate('orders.created_at', date('Y-m-d'))
                ->where('orders.status', '!=', 'pending')
                ->select(
                    'orders.*',
                    'therapists.nickname as nickname',
                    'therapists.name as name',
                    'therapists.id as therapistId',
                    // 'discounts.discount as discount',
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

        return view('dashboard.pdf.sales', [
            'title' => 'SALES REPORT',
            'days' => $extra_time->get(),
            'Now' => Carbon::now()->setTimezone('Asia/Makassar'),
            'totalADays' => $extra_time->sum('summary_extra_time'),
        ]);
    }
}
