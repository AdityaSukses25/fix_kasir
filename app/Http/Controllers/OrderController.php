<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Gender;
use App\Models\Therapist;
use App\Models\Discount;
use App\Models\Service;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $timeNow = Carbon::now('Asia/Makassar')->format('H:i:s');
        return view('dashboard.order.index', [
            'title' => 'Order',
            'genders' => Gender::all(),
            'places' => Place::all(),
            'therapists' => Therapist::all(),
            'discounts' => Discount::all(),
            'massages' => Service::all(),
            'users' => User::all(),
            'orders' => Order::all(),
            'now' => $timeNow,
            Order::where('end_service', '<', $timeNow)
                ->where('status', '=', 'on going')
                ->update([
                    'status' => 'success',
                ]),
        ]);
    }

    // therapist dropdown dinamic
    public function therapist($id)
    {
        $terapists = Therapist::where('gender_id', $id)->get();
        return response()->json($terapists);
    }

    public function storeOrder(Request $request)
    {
        $validatedData = $request->validate([
            'service_id' => 'required',
            'therapist_id' => 'required',
            'place_id' => 'required',
            'discount_id' => 'required',
            'cust_name' => 'required',
            'phone' => 'required',
            'time' => 'required',
            'price' => 'required',
            'start_service' => 'required',
            'end_service' => 'required',
            'payment_method' => 'required',
            'description' => 'required',
            'summary' => 'required',
        ]);

        $validatedData['reception_id'] = auth()->user()->id;
        $validatedData['status'] = 'on going';

        Order::create($validatedData);

        return Redirect('/order')->with('success', 'Data has been added!');
    }
}