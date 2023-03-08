<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CustomerController extends Controller
{
    public function index()
    {
        return view('dashboard.customer.index', [
            'customers' => Order::paginate(20),
            'title' => 'Customer',
        ]);
    }
}
