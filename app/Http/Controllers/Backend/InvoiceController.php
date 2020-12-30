<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
        $data['invoices'] = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
        return view('backend.invoice.index', $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['categories'] = Category::all();
        $data['customers'] = Customer::all();
        $data['date'] = date('Y-m-d');
        $invoice_data = Invoice::orderBy('id', 'desc')->first();
        if($invoice_data == null){
            $firstReg = '0';
            $data['invoice_no'] = $firstReg+1;
        } else{
            $invoice_data = Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $data['invoice_no'] = $invoice_data+1;
        }
        return view('backend.invoice.add-invoice', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->category_id == null){
            dd('ee');
        } else{
            if($request->paid_amount > $request->estimated_amount){
                return redirect()->back()->with('error', 'Sorry! paid amount is more than total amount');
            } else {
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = 0;
                $invoice->created_by = auth()->user()->id;

                DB::transaction(function () use($request, $invoice){
                    if($invoice->save()){
                        $count_category = count($request->category_id);
                        for ($i=0; $i < $count_category; $i++){
                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('Y-m-d', strtotime($request->date));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status = '1';
                            $invoice_details->save();
                        }
                        if($request->customer_id == '0'){
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->phone = $request->phone;
                            $customer->address = $request->address;
                            $customer->save();
                            $customer_id = $customer->id;
                        } else {
                            $customer_id = $request->customer_id;
                        }

                        $payment = new Payment();
                        $payment_details = new PaymentDetail();
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;

                        if($request->paid_status == 'full_paid'){
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                        } elseif ($request->paid_status == 'full_due'){
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0';
                        }elseif ($request->paid_status == 'partial_paid'){
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $payment_details->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();
                        $payment_details->invoice_id = $invoice->id;
                        $payment_details->date = date('Y-m-d', strtotime($request->date));
                        $payment_details->save();

                    }
                });

            }
        }

        return redirect()->route('invoice.pending.list')->with('success', 'Data saved successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['purchase'] = Purchase::findOrFail($id);
        $data['suppliers'] = Supplier::all();
        $data['units'] = Unit::all();
        $data['categories'] = Category::all();
        return view('backend.purchase.edit-purchase', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Purchase::findOrFail($id);
        $request->validate([
            'name'=>'required',
            'supplier_id'=>'required',
            'category_id'=>'required',
            'unit_id'=>'required',
        ]);

        $request['updated_by'] = auth()->user()->id;
        $product->update($request->all());

        return redirect()->route('purchases.index')->with('success', 'Data updated succesfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('ok');
    }

    public function delete($id)
    {
//        Purchase::findOrFail($id)->delete();
//        $supplier->delete();
        $invoice = Invoice::findOrFail($id);
        InvoiceDetail::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetail::where('invoice_id', $invoice->id)->delete();
        $invoice->delete();
        return redirect()->route('invoice.pending.list')->with('success', 'Data deleted succesfully');
    }

    public function pendingList(){
        $data['invoices'] = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        return view('backend.invoice.pending-invoice-list', $data );
    }
    public function approve($id){
        $invoice = Invoice::with(['invoice_details'])->findOrFail($id);
        return view('backend.invoice.invoice-approve', compact('invoice'));

    }
    public function approvalStore(Request $request, $id){
        foreach ($request->selling_qty as $key => $val){
            $invoic_details = InvoiceDetail::where('id', $key)->first();
            $product = Product::where('id', $invoic_details->product_id)->first();
            if($product->quantity < $request->selling_qty[$key]){
                return redirect()->back()->with('error', 'Sorry! You approve maximum value');
            }
        }
        $invoice = Invoice::find($id);
        $invoice->approved_by = auth()->user()->id;
        $invoice->status = '1';
        DB::transaction(function () use ($request, $invoice, $id){
            foreach ($request->selling_qty as $key => $val){
                $invoic_details = InvoiceDetail::where('id', $key)->first();
                $invoic_details->status = '1';
                $invoic_details->save();
                $product = Product::where('id', $invoic_details->product_id)->first();
                $product->quantity = ((float)$product->quantity)-((float)$request->selling_qty[$key]);
                $product->save();
            }
            $invoice->save();
        });
        return redirect()->route('invoice.pending.list')->with('success', 'Invoice successfully approved');
    }

    public function printInvoiceList(){
        $data['invoices'] = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
        return view('backend.invoice.pos-invoice-list', $data );
    }
    public function printInvoice($id){
        $data['invoice'] = Invoice::with(['invoice_details'])->findOrFail($id);

        $pdf = PDF::loadView('backend.pdf.invoice-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

        /*$pdf = PDF::loadView('backend.pdf.invoice-pdf', $data);
        return $pdf->download('invoice.pdf');*/

        /*$pdf = App::make('dompdf.wrapper');
        $pdf->loadView('backend.pdf.invoice-pdf', $data);
        return $pdf->stream();*/

        /*$pdf = PDF::loadView('backend.pdf.invoice-pdf', $data)->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->stream('document.pdf');*/
    }


    function dailyReport() {
        return view('backend.invoice.daily-invoice-report');
    }
    function dailyReportPdf(Request $request) {
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        $data['allData'] = Invoice::whereBetween('date', [$sdate, $edate])->where('status', '1')->get();

        $data['start_date'] = $sdate;
        $data['end_date'] = $edate;

        $pdf = PDF::loadView('backend.pdf.invoice-pdf-report', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
