<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Section;
use App\Models\Product;
use App\Notifications\AddInvoiceNotification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['sections'] = Section::orderBy('id','DESC')->limit(5)->get();
        $data['products'] = Product::orderBy('id','DESC')->limit(5)->get();
        $invoices_count = Invoice::count();
        $data['paid_invoices_count']= Invoice::where('status','paid')->count();
        $data['unpaid_invoices_count'] = Invoice::where('status','unpaid')->count();
        $data['recently_paid'] = Invoice::orderBy('payment_date','desc')->first();

        if( $invoices_count != null ){
        $unpaid_percentage = round(Invoice::where('status','unpaid')->count()/  $invoices_count * 100 ,2);
        $paid_percentage = round(Invoice::where('status','paid')->count() /  $invoices_count * 100,2);
        }



    //chart js
    if($invoices_count != null){
        $bieChartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 300, 'height' => 320])
        ->labels(['Label x', 'Label y'])
        ->datasets([
            [
                'backgroundColor' => ['rgba(255, 99, 132, 0.2)',  'rgba(54, 162, 235, 0.2)','#BF9270'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                'data' => [$unpaid_percentage, $paid_percentage]
            ]
        ])
        ->options([]);


        $barChartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 300, 'height' => 200])
            ->labels(['Unpaid invoices', 'Paid invoices'])
            ->datasets([

                [
                    "label" => "Unpaid Invoices",
                    'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)','#BF9270'],
                    'data' => [$unpaid_percentage, $paid_percentage]
                ],
                [
                    "label" => "Paid Invoices",
                    'backgroundColor' => ['rgba(54, 162, 235, 0.2)'],
                    'data' => [0, 0,0]
                ],
            





            ])
            ->options([
                'legend' => [
                    'display' => true,
                    'labels' => [
                        'fontColor' => '#000'
                    ]
                    ],

            ]);


        return view('dashboard.index',['bieChartjs' =>$bieChartjs,'barChartjs'=>$barChartjs,'invoices_count'=>$invoices_count])->with($data);
    }
    else{
        return view('dashboard.index',['invoices_count'=>$invoices_count])->with($data);
    }
}

}





