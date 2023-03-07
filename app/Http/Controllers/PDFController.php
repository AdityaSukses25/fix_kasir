<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Order;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PDFController extends Controller
{
    public function index(Request $request)
    {
        $dateNow = Order::whereDate('created_at', '=', Date('Y-m-d'));
        if (request('start_sales') && request('end_sales')) {
            $dateNow = Order::whereBetween('created_at', [
                request('start_sales'),
                request('end_sales'),
            ]);
        }

        $therapist = Therapist::get();
        $order = Order::get();
        $AmountOfSalary = $therapist->map(function ($therapist) use ($order) {
            $amountOfOrder = $order
                ->where('therapist_id', $therapist->id)
                ->count();
            $salary = $amountOfOrder * $therapist->commision;
            return [
                'therapist_name' => $therapist->name,
                'order_amount' => $amountOfOrder,
                'salary' => $salary,
            ];
        });
        return view('dashboard.pdf.sales', [
            'title' => 'SALES REPORT',
            'days' => $dateNow->get(),
            'totalADays' => $dateNow->sum('summary'),
            'salarys' => $AmountOfSalary,
            // 'Summary' => $AmountOfSalary->sum('salary'),
        ]);
    }
}
