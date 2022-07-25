<?php

namespace App\Http\Controllers;

use toastr;
use Exception;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\InvoiceDetails;
use App\Models\InvoiceAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreInvoiceRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AddInvoiceNotification;
use App\Notifications\AddInvoice;
use App\Exports\InvoiceExport;
use Maatwebsite\Excel\Facades\Excel;


class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['invoices'] = Invoice::all();
        return view('invoices.index')->with($data);
    }

    public function create()
    {
        $data['products'] = Product::all();
        $data['sections'] = Section::all();
        return view('invoices.create')->with($data);
    }

    public function store(Request $request)
    {

            // $request->validate([
            //     'invoice_number' => 'required|string',
            //     'product_id' => 'required|exists:products,id',
            //     'section_id' => 'required|exists:sections,id',
            //     'amount_collection' => 'required|numeric',
            //     'amount_commission' => 'required|numeric',
            //     'discount' => 'required|numeric',
            //     'note' => 'nullable|string',
            //     // 'file_name' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            // ]);
            Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'section_id' => $request->section_id,
            'product_id' => $request->product_id,
            'collection_amount' => $request->collection_amount,
            'commission_amount' => $request->commission_amount,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vat' => $request->rate_vat,
            'total' => $request->total,
            'status' => 'unpaid',
            'value_status' => 2,
            'note' => $request->note,
            'payment_date' => $request->payment_date,
        ]);

        $invoice_id= Invoice::latest()->first()->id;


        // $details = new InvoiceDetails();
        //     $details->invoice_number = $invoice->invoice_number;
        //     $details->section_id = $invoice->section_id;
        //     $details->product_id = $invoice->product_id;
        //     $details->invoice_id = $invoice->id;
        //     $details->status = 'not paid';
        //     $details->value_status = 2;
        //     $details->note = $invoice->note;
        //     $details->payment_date = $request->payment_date;
        //     $details->user = Auth::user()->name;
        //     $details->save();


            // if ($request->hasFile('file_name')){
            //     $path = $request->file('file_name')->storeAs(
            //         $invoice->invoice_number , $request->file('file_name')->getClientOriginalName()
            // );

            // $invoiceAttachment = new InvoiceAttachment();
            // $invoiceAttachment->file_name = $path;
            // $invoiceAttachment->invoice_number = $request->invoice_number;
            // $invoiceAttachment->created_by = Auth::user()->name;
            // $invoiceAttachment->invoice_id = $invoice->id;
            // $invoiceAttachment->save();
            // }

        toastr()->success('New invoice added successfully');

        // $user = Auth::user();
        // $user = User::first();
        // Notification::send($user, new AddInvoice($invoice_id));


        $users = User::where('id','!=',auth()->user()->id)->get();
        $user_create = Auth::user()->name;
        Notification::send($users, new AddInvoiceNotification($invoice_id));
        return redirect()->route('invoices.index');

    }

    public function show($id)
    {
        $invoice= Invoice::findOrFail($id);
        $data['invoice_details'] = InvoiceDetails::where('invoice_id',$invoice->id)->get();
        $data['invoice_attachments']  = InvoiceAttachment::where('invoice_number',$invoice->invoice_number)->get();
        return view('invoices.invoice_details',['invoice'=>$invoice])->with($data);
    }


    public function edit($id)
    {
        $data['invoice'] = Invoice::findOrFail($id);
        $data['products'] = Product::all();
        $data['sections'] = Section::all();
        return view('invoices.edit')->with($data);
    }

    public function update(Request $request)
    {
        // DB::beginTransaction();
        try {
            $invoice = Invoice::findOrFail($request->invoice_id);

            $invoice->update([
                'invoice_number' => $invoice->invoice_number,
                'invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'section_id' => $request->section_id,
                'product_id' => $request->product_id,
                'collection_amount' => $request->collection_amount,
                'commission_amount' => $request->commission_amount,
                'discount' => $request->discount,
                'value_vat' => $request->value_vat,
                'rate_vat' => $request->rate_vat,
                'total' => $request->total,
                'note' => $request->note,
                'status' => 'not paid',
                'value_status' => 2,

            ]);
            // return $updatedInvoice = DB::table('invoices')->order_by('updated_at', 'desc')->first();
        // $invoice_details= InvoiceDetails::where('invoice_id',$invoice->id)->first();
        // $invoice_details->update([
        //     'invoice_number' => $request->invoice_number,
        //     'product_id' => $request->product_id,
        //     'section_id' => $request->section_id,
        //     'invoice_id' => $request->invoice_id,
        //     'status' => $invoice->status,
        //     'value_status' => 2,
        //     'note' => $request->note,
        //     'user' => Auth::user()->name,
        //     ]);

        // $invoice_attachments = InvoiceAttachment::where('invoice_id',$request->invoice->id)->get();
        // if ($request->hasFile('file_name')){
        //     foreach ($invoice_attachments as $key => $attach) {
        //         $path = $attach->file_name;
        //         Storage::delete($path);
        //     }


        //     $path = $request->file('file_name')->storeAs(
        //         $invoice_number , $request->file('file_name')->getClientOriginalName()
        //     );

        //     $invoice_attachment->update([
        //         'file_name' => $path,
        //         'invoice_number' => $request->invoice_number,
        //         'created_by' => Auth::user()->name,
        //         'invoice_id' => $invoice->id,
        //         ]);


        // }



        // DB::commit();
        toastr()->success('Invoice updated successfully');
        return back();
        }
            catch(Exception $e){
            // DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $invoice = Invoice::findOrFail($request->invoice_id);
        if($request->archive_invoice == 'archive'){
            $invoice->Delete();
            toastr()->success('Invoice has been archived successfully');
        }else {
            $invoice->forceDelete();
            toastr()->success('Invoice has been deleted successfully');
        }
        return redirect()->back();
    }


    public function getProdsBySection($id)
    {
        $list_prods = Product::where('section_id',$id)->pluck('product_name','id');
        return response()->json($list_prods);
    }

    public function edit_status($invoice_id)
    {
        $data['invoice'] = Invoice::findOrFail($invoice_id);
        $data['sections'] = Section::all();
        $data['products'] = Product::all();
        return view('invoices.edit_status')->with($data);
    }

    public function update_status($invoice_id,Request $request)
    {
        try {
            $invoice = Invoice::findOrFail($invoice_id);
            if($request->status === 'paid'){
                $invoice->update([
                    'invoice_number' => $invoice->invoice_number,
                    'invoice_date' => $invoice->invoice_date,
                    'due_date' => $invoice->due_date,
                    'section_id' => $invoice->section_id,
                    'product_id' => $invoice->product_id,
                    'collection_amount' => $invoice->collection_amount,
                    'commission_amount' => $invoice->commission_amount,
                    'discount' => $invoice->discount,
                    'value_vat' => $invoice->value_vat,
                    'rate_vat' => $invoice->rate_vat,
                    'total' => $invoice->total,
                    'status' => 'paid',
                    'value_status' => 1,
                    'note' => $invoice->note,
                    'payment_date' => $request->payment_date,

                ]);
            }
            elseif($request->status === 'partially paid'){
                $invoice->update([
                    'invoice_number' => $invoice->invoice_number,
                    'invoice_date' => $invoice->invoice_date,
                    'due_date' => $invoice->due_date,
                    'section_id' => $invoice->section_id,
                    'product_id' => $invoice->product_id,
                    'collection_amount' => $invoice->collection_amount,
                    'commission_amount' => $invoice->commission_amount,
                    'discount' => $invoice->discount,
                    'value_vat' => $invoice->value_vat,
                    'rate_vat' => $invoice->rate_vat,
                    'total' => $invoice->total,
                    'status' => 'partially_paid',
                    'value_status' => 3,
                    'note' => $invoice->note,
                    'payment_date' => $request->payment_date,

                ]);
            }
            else{
                $invoice->update([
                    'invoice_number' => $invoice->invoice_number,
                    'invoice_date' => $invoice->invoice_date,
                    'due_date' => $invoice->due_date,
                    'section_id' => $invoice->section_id,
                    'product_id' => $invoice->product_id,
                    'collection_amount' => $invoice->collection_amount,
                    'commission_amount' => $invoice->commission_amount,
                    'discount' => $invoice->discount,
                    'value_vat' => $invoice->value_vat,
                    'rate_vat' => $invoice->rate_vat,
                    'total' => $invoice->total,
                    'status' => 'unpaid',
                    'value_status' => 2,
                    'note' => $invoice->note,
                    'payment_date' => $request->payment_date,

                ]);
            }
            toastr()->success('Status updated successfully');
            return redirect()->route('invoices.index');

        }
       catch (\Exception $e) {
            return $e->getMessage();
        }

        $data['invoice'] = Invoice::findOrFail($request->invoice_id);
        $data['sections'] = Section::all();
        $data['products'] = Product::all();
        return view('invoices.edit_status')->with($data);
    }


    public function paid_invoices()
    {
        $data['paid_invoices'] = Invoice::where('status','paid')->get();
        return view('invoices.paid')->with($data);
    }

    public function unpaid_invoices()
    {
        $data['unpaid_invoices'] = Invoice::where('status','unpaid')->get();
        return view('invoices.unpaid')->with($data);
    }



    public function print_invoice($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        return view('invoices.print_invoice',['invoice'=>$invoice]);
    }


    //export invoices as excel
    public function export()
    {
        return Excel::download(new InvoiceExport, 'invoices.xlsx');
    }
    //mark all notifications as read
    public function mark_all_read()
    {
        $user = Auth::user();
        $user_unread_notifications = $user->unreadNotifications;
        if($user_unread_notifications){
            $user_unread_notifications->markAsRead();
            return back();
        }

    }
}
