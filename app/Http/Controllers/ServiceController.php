<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Place;
use App\Models\Discount;
class ServiceController extends Controller
{
    public function index()
    {
        return view('/dashboard.service.index', [
            'title' => 'Services',
            'massages' => Service::all(),
            'places' => Place::all(),
            'discounts' => Discount::all(),
        ]);
    }

    // massage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'massage' => 'required|max:255',
            'time' => 'required',
            'price' => 'required',
        ]);

        Service::create($validatedData);

        return Redirect('/service')->with('success', 'Service has been added!');
    }

    public function update(Request $request)
    {
        $updateService = Service::findorFail($request->massage_name);
        $updateService->massage = $request->massage;
        $updateService->time = $request->time;
        $updateService->price = $request->price;
        $updateService->save();

        return Redirect('/service')->with(
            'success',
            'Terapist has been updated!'
        );
    }

    public function destroy($id)
    {
        Service::destroy($id);

        return Redirect('/service');
    }
    // end massage

    // place
    public function storePlace(Request $request)
    {
        $validatedData = $request->validate([
            'place' => 'required',
        ]);

        Place::create($validatedData);

        return Redirect('/service')->with('success', 'Place has been added!');
    }

    public function updatePlace(Request $request)
    {
        $updateService = Place::findorFail($request->place_name);
        $updateService->place = $request->place;
        $updateService->save();

        return Redirect('/service')->with(
            'success',
            'Terapist has been updated!'
        );
    }

    public function destroyPlace($id)
    {
        Place::destroy($id);

        return Redirect('/service');
    }
    // end place

    // discount
    public function storeDiscount(Request $request)
    {
        $validatedData = $request->validate([
            'discount' => 'required',
        ]);

        Discount::create($validatedData);

        return Redirect('/service')->with(
            'success',
            'Discount has been added!'
        );
    }

    public function updateDiscount(Request $request)
    {
        $updateDiscount = Discount::findorFail($request->discount_name);
        $updateDiscount->discount = $request->discount;
        $updateDiscount->save();

        return Redirect('/service')->with(
            'success',
            'Discount has been updated!'
        );
    }

    public function destroyDiscount($id)
    {
        Discount::destroy($id);

        return Redirect('/service');
    }
    // end discount
}
