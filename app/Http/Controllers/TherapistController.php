<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Therapist;
use App\Models\Gender;
class TherapistController extends Controller
{
    public function index()
    {
        $terapist = collect(Therapist::all())->sortBy('name');
        return view('dashboard.therapist.index', [
            'title' => 'Therapist',
            'terapists' => $terapist,
            'genders' => Gender::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'nickname' => 'required',
            'gender_id' => 'required',
            'phone' => 'required',
            'presence' => 'required',
            'commision' => 'required',
        ]);

        $validatedData['status'] = 1;

        Therapist::create($validatedData);

        return Redirect('/therapist')->with(
            'success',
            'Terapist has been added!'
        );
    }

    public function update(Request $request)
    {
        $updateTerapist = Therapist::findorFail($request->terapist_name);
        $updateTerapist->name = $request->name;
        $updateTerapist->nickname = $request->nickname;
        $updateTerapist->gender_id = $request->gender_id;
        $updateTerapist->phone = $request->phone;
        $updateTerapist->status = $request->status;
        $updateTerapist->presence = $request->presence;
        $updateTerapist->commision = $request->commision;
        $updateTerapist->save();

        return Redirect('/therapist')->with(
            'success',
            'Terapist has been updated!'
        );
    }

    public function destroy($id)
    {
        Therapist::destroy($id);

        return Redirect('/therapist');
    }
}
