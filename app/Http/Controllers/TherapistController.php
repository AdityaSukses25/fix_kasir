<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Therapist;
use App\Models\attendence;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TherapistController extends Controller
{
    public function index()
    {
        $terapist = Therapist::where('status', '>', 0)
            ->orderBy('name', 'asc')
            ->get();
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
            'commision' => 'required',
        ]);

        $validatedData['status'] = 2;

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

        // $presence = attendence::where(
        //     created_at,
        //     Carbon::now()->toDateString()
        // )->get();
        // foreach ($presence as $key => $value) {
        //     $value = $value->therapist;
        //     $value->status = 1;
        //     $value->save();
        // }
        $updateTerapist->status = $request->status;
        $updateTerapist->commision = $request->commision;
        $updateTerapist->save();

        return Redirect('/therapist')->with(
            'success',
            'Terapist has been updated!'
        );
    }

    public function updateDelete(Request $request, $id)
    {
        $updateTerapist = Therapist::find($id);
        // $updateTerapist->name = $request->name;
        // $updateTerapist->nickname = $request->nickname;
        // $updateTerapist->gender_id = $request->gender_id;
        // $updateTerapist->phone = $request->phone;
        $updateTerapist->status = 0;
        // $updateTerapist->commision = $request->commision;
        $updateTerapist->save();

        return Redirect('/therapist')->with(
            'success',
            'Terapist has been updated Delete!'
        );
    }

    public function destroy($id)
    {
        $updateTerapist = Therapist::find($id);
        // $updateTerapist->name = $request->name;
        // $updateTerapist->nickname = $request->nickname;
        // $updateTerapist->gender_id = $request->gender_id;
        // $updateTerapist->phone = $request->phone;
        $updateTerapist->status = 0;
        // $updateTerapist->commision = $request->commision;
        $updateTerapist->save();
        // Therapist::destroy($id);

        return Redirect('/therapist');
    }
}
