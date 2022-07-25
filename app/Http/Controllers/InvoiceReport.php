<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceReport extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function search_invoices(Request $request)
    {
        $search_type = $request->search_type;
        if ($search_type == 1) {
            //search by invoice type without date range
            if($request->type && $request->start == '' && $request->end == ''){
                $data['invoices'] = Invoice::where('status',$request->type)->get();
                return view('reports.index')->with($data);
            }else {
                //search by invoice type with date range
                $from = date($request->start);
                $to = date($request->end);
                $data['invoices'] = Invoice::whereBetween('invoice_date', [$from, $to])
                ->where('status',$request->type)
                ->get();
                return view('reports.index')->with($data);
            }

            

        }
        //search by invoice number
        else{
            $data['invoices'] = Invoice::where('invoice_number',$request->invoice_number)->get();
            return view('reports.index')->with($data);
        }
        
    }
}
