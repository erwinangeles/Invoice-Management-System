<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Payment;
use App\Invoice;
use App\Client;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payments = Payment::all();
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.payments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Payment $payment)
    {
        //
        $payment = New Payment;
       $fetch_invoice = Invoice::where('id', '=', $request->invoice_id)->first();
        $payment->client_id = $fetch_invoice->client_id;
        $payment->invoice_id = $request->invoice_id;
        $payment->payment_amount = $request->payment_amount;
        $payment->payment_type = $request->payment_type;
        $payment->payment_date = $request->payment_date;
        $payment->transaction_reference = $request->transaction_reference;
        $payment->private_notes = $request->private_notes;
        $payment->save();

        if($payment->invoice->discount_type == 'Amount') {
            Invoice::where('id',$payment->invoice_id)->update(array(
                'amount'=> $payment->invoice->products->sum('line_total') * ((100+$payment->invoice->client->tax_rate) / 100),
                'balance'=> $payment->invoice->products->sum('line_total') * ((100+$payment->invoice->client->tax_rate) / 100)
                    - $payment->invoice->discount
                    - $payment->invoice->payments->sum('payment_amount')));
        }elseif($payment->invoice->discount_type == 'Percent'){
            Invoice::where('id',$payment->invoice_id)->update(array(
                'amount'=>  $payment->invoice->products->sum('line_total') * ((100+$payment->invoice->client->tax_rate) / 100),
                'balance'=> $payment->invoice->products->sum('line_total') * ((100-$payment->invoice->discount) / 100)+ ( $payment->invoice->products->sum('line_total') *  (100+$payment->invoice->client->tax_rate) / 100) -$payment->invoice->products->sum('line_total')-$payment->invoice->payments->sum('payment_amount'),
            ));
        }
        return redirect('admin/invoices/'.$payment->invoice_id.'/edit/');
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
    public function edit(Payment $payment)
    {
        //
        return view('admin.payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
        $payment->update($request->all());
        if($payment->invoice->discount_type == 'Amount') {
            Invoice::where('id',$payment->invoice_id)->update(array(
                'amount'=> $payment->invoice->products->sum('line_total') * ((100+$payment->invoice->client->tax_rate) / 100),
                'balance'=> $payment->invoice->products->sum('line_total') * ((100+$payment->invoice->client->tax_rate) / 100)
                    - $payment->invoice->discount
                    - $payment->invoice->payments->sum('payment_amount')));
        }elseif($payment->invoice->discount_type == 'Percent'){
            Invoice::where('id',$payment->invoice_id)->update(array(
                'amount'=>  $payment->invoice->products->sum('line_total') * ((100+$payment->invoice->client->tax_rate) / 100),
                'balance'=> $payment->invoice->products->sum('line_total') * ((100-$payment->invoice->discount) / 100)+ ( $payment->invoice->products->sum('line_total') *  (100+$payment->invoice->client->tax_rate) / 100) -$payment->invoice->products->sum('line_total')-$payment->invoice->payments->sum('payment_amount'),
            ));
        }
        return redirect('admin/invoices/'.$payment->invoice_id.'/edit/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
        $payment->delete();
        if($payment->invoice->discount_type == 'Amount') {
            Invoice::where('id',$payment->invoice_id)->update(array(
                'amount'=> $payment->invoice->products->sum('line_total') * ((100+$payment->invoice->client->tax_rate) / 100),
                'balance'=> $payment->invoice->products->sum('line_total') * ((100+$payment->invoice->client->tax_rate) / 100)
                    - $payment->invoice->discount
                    - $payment->invoice->payments->sum('payment_amount')));
        }elseif($payment->invoice->discount_type == 'Percent'){
            Invoice::where('id',$payment->invoice_id)->update(array(
                'amount'=>  $payment->invoice->products->sum('line_total') * ((100+$payment->invoice->client->tax_rate) / 100),
                'balance'=> $payment->invoice->products->sum('line_total') * ((100-$payment->invoice->discount) / 100)+ ( $payment->invoice->products->sum('line_total') *  (100+$payment->invoice->client->tax_rate) / 100) -$payment->invoice->products->sum('line_total')-$payment->invoice->payments->sum('payment_amount'),
            ));
        }
        return redirect()->back();
    }
}
