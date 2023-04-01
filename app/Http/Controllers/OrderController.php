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

class OrderController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        if (request('search')) {
            $orders = Order::whereDate('created_at', '=', $now)
                ->whereHas('therapist', function ($query) {
                    $query
                        ->where(
                            'nickname',
                            'like',
                            '%' . request('search') . '%'
                        )
                        ->orWhere(
                            'name',
                            'like',
                            '%' . request('search') . '%'
                        );
                })
                ->orWhere('cust_name', 'like', '%' . request('search') . '%')
                ->whereDate('created_at', '=', $now)
                ->orWhere(
                    'start_service',
                    'like',
                    '%' . request('search') . '%'
                )
                ->whereDate('created_at', '=', $now)
                ->orWhere('end_service', 'like', '%' . request('search') . '%')
                ->whereDate('created_at', '=', $now)
                ->orWhere('status', 'like', '%' . request('search') . '%')
                ->whereDate('created_at', '=', $now)
                ->latest()
                ->get();
        } else {
            $orders = Order::whereDate('created_at', '=', date('Y-m-d'))
                ->latest()
                ->get();
        }

        $timeNow = Carbon::now('Asia/Makassar')->format('H:i:s');

        $extra_time = DB::table('orders')
            ->join('extra_times', 'orders.id', '=', 'extra_times.order_id')
            ->join('therapists', 'orders.therapist_id', '=', 'therapists.id')
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->join('discounts', 'orders.discount_id', '=', 'discounts.id')
            ->join('places', 'orders.place_id', '=', 'places.id')
            ->join(
                'services as services_extra',
                'extra_times.service_id',
                '=',
                'services_extra.id'
            )
            ->whereDate('orders.created_at', date('Y-m-d'))
            ->select(
                'orders.*',
                'therapists.nickname as nickname',
                'therapists.name as name',
                'therapists.id as therapistId',
                'discounts.discount as discount',
                'extra_times.start_extra_time',
                'extra_times.id as extraId',
                'extra_times.end_extra_time',
                'extra_times.extra_time',
                'extra_times.price_extra_time as priceExtra',
                'services.massage as massage',
                'services_extra.massage as massageExtra',
                'places.place as place'
            )
            ->orderBy('id', 'desc');

        if (\request('search')) {
            $extra_time = DB::table('orders')
                ->join('extra_times', 'orders.id', '=', 'extra_times.order_id')
                ->where(function ($query) {
                    $query
                        ->where(
                            'orders.cust_name',
                            'like',
                            '%' . request('search') . '%'
                        )
                        ->orWhere(
                            'orders.id',
                            'like',
                            '%' . request('search') . '%'
                        )
                        ->orWhere(
                            'orders.status',
                            'like',
                            '%' . request('search') . '%'
                        )
                        ->orWhere(
                            'therapists.nickname',
                            'like',
                            '%' . request('search') . '%'
                        );
                })
                ->join(
                    'therapists',
                    'orders.therapist_id',
                    '=',
                    'therapists.id'
                )
                ->join('services', 'orders.service_id', '=', 'services.id')
                ->join('discounts', 'orders.discount_id', '=', 'discounts.id')
                ->join('places', 'orders.place_id', '=', 'places.id')

                ->join(
                    'services as services_extra',
                    'extra_times.service_id',
                    '=',
                    'services_extra.id'
                )
                ->whereDate('orders.created_at', date('Y-m-d'))
                ->select(
                    'orders.*',
                    'therapists.nickname as nickname',
                    'therapists.name as name',
                    'therapists.id as therapistId',
                    'extra_times.start_extra_time',
                    'discounts.discount as discount',
                    'extra_times.id as extraId',
                    'extra_times.end_extra_time',
                    'extra_times.extra_time',
                    'extra_times.price_extra_time as priceExtra',
                    'services.massage as massage',
                    'places.place as place',
                    'services_extra.massage as massageExtra'
                )
                ->orderBy('id', 'desc');
        }

        $orderId = Order::whereDate('created_at', Date('Y-m-d'))->count();
        $orderId = $orderId + 1;

        $onGoingOrders = DB::table('orders')
            ->where('status', 'on going')
            ->pluck('place_id');
        $place = DB::table('places')
            ->leftjoin('orders', 'places.id', '=', 'orders.place_id')
            ->whereNotIn('places.id', $onGoingOrders)
            ->where('places.status', 2)
            ->select('places.id', 'places.place')
            ->groupBy('places.id', 'places.place')
            ->get();

        return view('dashboard.order.index', [
            'title' => 'Order',
            'genders' => Gender::all(),
            'places' => $place,
            'discounts' => Discount::where('status', 2)->get(),
            'massages' => Service::where('status', 2)->get(),
            'users' => User::all(),
            'orders' => $orders,
            'orderId' => '#' . $orderId,
            'extra_time' => $extra_time->get(),

            'finish' => Order::whereDate('created_at', Date('Y-m-d'))
                ->where('status', 'finish')
                ->count(),
            'onGoing' => Order::whereDate('created_at', Date('Y-m-d'))
                ->where('status', 'on going')
                ->count(),
            'pending' => Order::whereDate('created_at', Date('Y-m-d'))
                ->where('status', 'pending')
                ->count(),
        ]);
    }

    // therapist dropdown dinamic
    public function therapist($id)
    {
        $onGoingOrders = DB::table('orders')
            ->where('status', 'on going')
            ->pluck('therapist_id');

        $therapists = DB::table('therapists')
            ->leftJoin('orders', 'therapists.id', '=', 'orders.therapist_id')
            ->whereNotIn('therapists.id', $onGoingOrders)
            ->where('gender_id', $id)
            ->select(
                'therapists.id',
                'therapists.nickname',
                'therapists.status',
                DB::raw('COUNT(orders.id) as order_count'),
                DB::raw(
                    'COUNT(CASE WHEN orders.created_at >= CURDATE() THEN 1 END) as today_order_count'
                )
            )
            ->groupBy(
                'therapists.id',
                'therapists.nickname',
                'therapists.status'
            )
            ->get();

        return response()->json($therapists);
    }

    public function store(Request $request)
    {
        $orderId = Order::whereDate('created_at', Date('Y-m-d'))->count();
        $orderId = $orderId + 1;
        $validatedData = $request->validate([
            'service_id' => 'required',
            'therapist_id' => 'required',
            'place_id' => 'required',
            'discount_id' => 'required',
            'cust_name' => 'required',
            'phone' => 'required',
            'time' => 'required',
            'price' => 'required',
            'payment_method' => 'required',
            'description' => '',
            'summary' => 'required',
        ]);

        $validatedData['reception_id'] = auth()->user()->id;
        $validatedData['status'] = 'pending';

        Order::create($validatedData);

        return Redirect('/order')->with('success', 'Order has been added!');
    }

    public function update(Request $request)
    {
        $updateOrder = Order::findorFail($request->order_name);
        $updateOrder->status = 'on going';
        $updateOrder->start_service = $request->start_service;
        $updateOrder->end_service = $request->end_service;
        $updateOrder->save();
        return back()->with('success', 'Service is goin on');
    }

    public function updateExtra(Request $request)
    {
        $updateExtra = ExtraTime::findorFail($request->order_extra);
        $updateExtra->status = 'extra';
        $updateExtra->therapist_id = $request->therapist_id;
        $updateExtra->service_id = $request->service_extra_time_id;
        $updateExtra->extra_time = $request->extra_time;
        $updateExtra->price_extra_time = $request->price_extra_time;
        $updateExtra->price_extra_time = $request->price_extra_time;
        $updateExtra->start_extra_time = $request->start_extra_time;
        $updateExtra->end_extra_time = $request->end_extra_time;
        $updateExtra->summary_extra_time = $request->summary_extra_time;
        $updateExtra->save();

        return back()->with('success', 'Extra Time is goin on');
    }

    public function finish($id)
    {
        $updateOrder = Order::find($id);
        $updateOrder->status = 'finish';
        $updateOrder->save();
        return back();
    }

    public function finishExtra($id)
    {
        $updateOrder = Order::find($id);
        $updateOrder->status = 'finish';
        $updateOrder->save();

        $updateExtra = ExtraTime::find($id);
        $updateExtra->status = 'finish';
        $updateExtra->save();
        return back();
    }
}
