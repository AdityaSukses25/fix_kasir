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
            'massages' => Service::where('status', '>', 0)
                ->orderBy('massage', 'asc')
                ->get(),
            'places' => Place::where('status', '>', 0)
                ->orderBy('place', 'asc')
                ->get(),
            'discounts' => Discount::where('status', '>', 0)
                ->orderBy('discount', 'asc')
                ->get(),
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

        $validatedData['status'] = 1;

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
        $updateService = Service::find($id);
        $updateService->status = 0;
        $updateService->save();

        return Redirect('/service');
    }
    // end massage

    // place
    public function storePlace(Request $request)
    {
        $validatedData = $request->validate([
            'place' => 'required',
        ]);
        $validatedData['status'] = 1;

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
        $updatePlace = Place::find($id);
        $updatePlace->status = 0;
        $updatePlace->save();

        return Redirect('/service');
    }
    // end place

    // discount
    public function storeDiscount(Request $request)
    {
        $validatedData = $request->validate([
            'discount' => 'required',
        ]);
        $validatedData['status'] = 1;

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
        $updateDiscount = Discount::find($id);
        $updateDiscount->status = 0;
        $updateDiscount->save();

        return Redirect('/service');
    }
    // end discount
}
