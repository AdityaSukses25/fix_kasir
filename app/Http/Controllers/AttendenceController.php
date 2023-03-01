<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Therapist;
use App\Models\attendence;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    public function index()
    {
        return view('dashboard.attend.index', [
            'title' => 'Presence',
            'presences' => attendence::all(),
        ]);
    }

    public function store(Request $request)
    {
        $timezone = 'Asia/Makassar';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $dateNow = $date->format('Y-m-d');
        $localtime = $date->format('H:i:s');
        $therapist = Therapist::get();

        $presence = attendence::where([
            ['therapist_id', '=', $therapist->id],
            ['created_at', '=', $dateNow],
        ])->first();

        if ($presence) {
            dd('sudah ada');
        } else {
            $validatedData = $request->validate([
                'therapist_id' => 'required',
                'time_start' => 'required',
            ]);
            attendence::create($validatedData);

            dd('berhasil');
        }
    }
}
