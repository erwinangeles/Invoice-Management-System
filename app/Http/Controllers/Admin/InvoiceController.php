<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Invoice;
use App\Profile;
use Illuminate\Http\Request;
use PDF;
use DB;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = Invoice::all();
        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Invoice::create($request->all());
        return redirect()->route('admin.invoices.index');
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
        $invoice = Invoice::findorfail($id);
        $profile = Profile::findorfail(1);
        return view('admin.invoices.view_invoice', compact('invoice', 'profile'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
        return view('admin.invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Invoice $invoice)
    {
        //
        $invoice->update($request->all());
        $invoice->amount = $invoice->products->sum('line_total')* ((100+$invoice->client->tax_rate) / 100);
        if($request->discount_type == 'Amount') {
            $invoice->balance =
                $invoice->products->sum('line_total') * ((100+$invoice->client->tax_rate) / 100)
                - $request->discount
                - $invoice->payments->sum('payment_amount');
        }elseif($request->discount_type == 'Percent'){
        $invoice->balance =
            $invoice->products->sum('line_total') * ((100-$invoice->discount) / 100)
            + ( $invoice->products->sum('line_total')
                *  (100+$invoice->client->tax_rate) / 100)
            -$invoice->products->sum('line_total')
            -$invoice->payments->sum('payment_amount');
        }
        $invoice->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }
    public function generatePDF($id)
    {
        $invoice = Invoice::findorfail($id);
        $profile = Profile::findorfail(1);
        $pdf = PDF::loadView('admin.invoices.view_invoice',compact('invoice','profile'));
        // download pdf
        return $pdf->download('invoice.pdf');
    }

    public function mobilePreview($id)
    {
        $profile = Profile::findorFail(1);
        $invoice = Invoice::findorfail($id);
        return view('admin.invoices.mobile_invoice', compact('profile', 'invoice'));
    }


}

