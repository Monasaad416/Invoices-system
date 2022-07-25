<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Product;
use App\Models\Invoice;

class CustomerInvoiceReport extends Controller
{
    public function index()
    {
        
        $data['sections'] = Section::all();
        $data['products'] = Product::all();
        return view('reports.customers_reports')->with($data);
    }

    public function search_cutomer_invoices(Request $request)
    {
            //search by customer without date range
            if($request->section_id && $request->product_id && $request->start == '' && $request->end == ''){
                $data['sections'] = Section::all();
                $data['products'] = Product::all();
                $data['invoices'] = Invoice::where('section_id',$request->section_id)->where('product_id',$request->product_id)->get();
                return view('reports.customers_reports')->with($data);
            }else {
                 //search by customer with date range
                $from = date($request->start);
                $to = date($request->end);
                $data['sections'] = Section::all();
                $data['products'] = Product::all();
                $data['invoices'] = Invoice::whereBetween('invoice_date', [$from, $to])
                ->where('section_id',$request->section_id)
                ->where('product_id',$request->product_id)
                ->get();
                return view('reports.customers_reports')->with($data);
            }     
    }
}
