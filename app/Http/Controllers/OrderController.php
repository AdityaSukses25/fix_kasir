<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Gender;
use App\Models\Therapist;
use App\Models\Discount;
use App\Models\Service;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('dashboard.order.index', [
            'title' => 'Order',
            'genders' => Gender::all(),
            'places' => Place::all(),
            'therapists' => Therapist::all(),
            'discounts' => Discount::all(),
            'massages' => Service::all(),
        ]);
    }

    // therapist dropdown dinamic
    public function therapist($id)
    {
        $terapists = Therapist::where('gender_id', $id)->get();
        return response()->json($terapists);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // 'service_id' => 'required',
            // 'therapist_id' => 'required',
            // 'place_id' => 'required',
            // 'discount_id' => 'required',
            'cust_name' => 'required|min:5',
            // 'phone' => 'required',
            // 'time' => 'required',
            // 'price' => 'required',
            // 'payment_method' => 'required',
            // 'description' => 'required',
            // 'summary' => 'required',
        ]);

        // $validatedData['reception_id'] = auth()->user()->id;

        Order::create($validatedData);

        return Redirect('/order', 'Data has been added!');
    }
}
