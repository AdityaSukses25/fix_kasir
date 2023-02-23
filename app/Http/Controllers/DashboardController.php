<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Therapist;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dash.index', [
            'title' => 'Dashboard',
            'orders' => Order::whereDate(
                'created_at',
                '=',
                date('Y-m-d')
            )->get(),
            'therapists' => Therapist::where('status', 1)->get(),
        ]);
    }
}
