<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\InvoiceAttachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class InvoiceAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(([
            'file_name' => 'nullable|mimes:pdf,png,jpg,jpeg,gif',
        ]));

        try {
            $path = $request->file('file_name')->storeAs(
                $request->invoice_number , $request->file('file_name')->getClientOriginalName()
            );
            InvoiceAttachment::create([
                'file_name' => $path,
                'invoice_number' => $request->invoice_number,
                'created_by' => Auth::user()->name,
                'invoice_id' => $request->invoice_id
            ]);

            toastr()->success('Data saved successfully');
            return redirect()->back();
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceAttachment $invoiceAttachment)
    {
        return "hhhhhhhhhhhhh";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceAttachment $invoiceAttachment)
    {
        return "jjjjjjjjjjjjjjjjjjjjj";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $file_name = InvoiceAttachment::findOrFail($request->file_id)->delete();
            $path = $request->invoice_no . "/" .$request->file_name;
            Storage::delete($path);
            toastr()->success('Attachment deleted successfully');
            return back();
        }
        catch(Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function download_attchment($invoice_number,$file)
    {
        return Storage::download($invoice_number ."/" . $file);


    }
    public function view_attchment($invoice_number,$file)
    {
        $data['image'] = $invoice_number . "/" . $file;
        return view('invoices.show_attachment')->with($data);


    }
}
