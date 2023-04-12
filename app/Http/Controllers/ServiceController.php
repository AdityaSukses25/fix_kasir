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
        $service = Service::orderBy('massage', 'asc');
        $place = Place::orderBy('place', 'asc');
        $discount = Discount::orderBy('discount', 'asc');
        if (\request('search')) {
            $service = Service::where(
                'status',
                'like',
                '%' . \request('search') . '%'
            )->orderBy('massage', 'asc');
            $place = Place::where(
                'status',
                'like',
                '%' . \request('search') . '%'
            )->orderBy('place', 'asc');
            $discount = Discount::where(
                'status',
                'like',
                '%' . \request('search') . '%'
            )->orderBy('discount', 'asc');
        }
        return view('/dashboard.service.index', [
            'title' => 'Service',
            'massages' => $service->get(),
            'places' => $place->get(),
            'discounts' => $discount->get(),
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

        $validatedData['status'] = 2;

        Service::create($validatedData);

        return Redirect('/service')->with('success', 'Service has been added!');
    }

    public function update(Request $request)
    {
        $updateService = Service::findorFail($request->massage_name);
        $updateService->massage = $request->massage;
        $updateService->time = $request->time;
        $updateService->price = $request->price;
        $updateService->status = $request->status;
        $updateService->save();

        return Redirect('/service')->with(
            'success',
            'Service has been updated!'
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
            'facility' => 'required',
        ]);
        $validatedData['status'] = 2;

        Place::create($validatedData);

        return Redirect('/service')->with('success', 'Place has been added!');
    }

    public function updatePlace(Request $request)
    {
        $updateService = Place::findorFail($request->place_name);
        $updateService->place = $request->place;
        $updateService->facility = $request->facility;
        $updateService->status = $request->status;
        $updateService->save();

        return Redirect('/service')->with('success', 'Place has been updated!');
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
        $validatedData['status'] = 2;

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
        $updateDiscount->status = $request->status;
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
