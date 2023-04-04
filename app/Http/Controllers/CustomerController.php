<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Therapist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // sales
        if (
            (request('start_date') &&
                request('end_date') &&
                request('search')) ||
            (request('start_date') && request('end_date'))
        ) {
            $extra_time = DB::table('orders')
                ->join('extra_times', 'orders.id', '=', 'extra_times.order_id')
                ->join(
                    'therapists',
                    'orders.therapist_id',
                    '=',
                    'therapists.id'
                )
                ->join('users', 'orders.reception_id', '=', 'users.id')

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
                    'users.name as Rname',
                    'therapists.name as Tname',
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
                ->where(function ($query) {
                    $query
                        ->whereBetween('orders.created_at', [
                            request('start_date'),
                            request('end_date'),
                        ])
                        ->where(function ($query) {
                            $search = '%' . request('search') . '%';
                            $query
                                ->where('orders.order_name', 'like', $search)
                                ->orWhere('services.massage', 'like', $search)
                                ->orWhere('users.name', 'like', $search)
                                ->orWhere('therapists.name', 'like', $search)
                                ->orWhere('orders.cust_name', 'like', $search);
                        });
                })
                ->orderBy('id', 'desc');
        } elseif (request('search')) {
            $extra_time = DB::table('orders')
                ->join('extra_times', 'orders.id', '=', 'extra_times.order_id')
                ->join(
                    'therapists',
                    'orders.therapist_id',
                    '=',
                    'therapists.id'
                )
                ->join('users', 'orders.reception_id', '=', 'users.id')

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
                    'users.name as Rname',
                    'therapists.name as Tname',
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
                ->where(function ($query) {
                    $search = '%' . request('search') . '%';
                    $query
                        ->where('orders.order_name', 'like', $search)
                        ->orWhere('orders.cust_name', 'like', $search)
                        ->orWhere('services.massage', 'like', $search)
                        ->orWhere('users.name', 'like', $search)
                        ->orWhere('therapists.name', 'like', $search);
                })
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
                ->join('users', 'orders.reception_id', '=', 'users.id')
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
                    'therapists.name as Tname',
                    'users.name as Rname',
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
        return view('dashboard.transaction.index', [
            'title' => 'Transaction Record',
            'days' => $extra_time->get(),
            'totalADays' => $extra_time->sum('summary_extra_time'),
        ]);
    }
}
