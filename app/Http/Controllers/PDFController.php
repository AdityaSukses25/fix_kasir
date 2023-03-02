<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PDFController extends Controller
{
    public function index(Request $request)
    {
        $dateNow = Order::whereDate('created_at', '=', Date('Y-m-d'));
        if (request('start_date') && request('end_date')) {
            $dateNow = Order::whereBetween('created_at', [
                request('start_date'),
                request('end_date'),
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
        return view('dashboard.pdf.index', [
            'title' => 'SALES REPORT',
            'days' => $dateNow->get(),
            'totalADays' => $dateNow->sum('summary'),
            'salarys' => $AmountOfSalary,
            'Summary' => $AmountOfSalary->sum('salary'),
        ]);
    }

    public function printSales()
    {
        $html = View::make('dashboard.pdf.index')->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('dashboard.pdf.index', [
            'title' => 'SALES REPORT',
            'Attachment' => false,
            'days' => $dateNow->get(),
            'totalADays' => $dateNow->sum('summary'),
            'salarys' => $AmountOfSalary,
            'Summary' => $AmountOfSalary->sum('salary'),
        ]);
    }
}
