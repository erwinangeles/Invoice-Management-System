<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Invoice;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        //
        $product = new Product;
        $product->invoice_id = $request->invoice_id;
        $product->item_name = $request->item_name;
        $product->item_description = $request->item_description;
        $product->unit_cost = $request->unit_cost;
        $product->quantity = $request->quantity;
        $product->line_total = $request->unit_cost * $request->quantity;
        $product->save();
        if($product->invoice->discount_type == 'Amount') {
            Invoice::where('id',$product->invoice_id)->update(array(
                'amount'=> $product->invoice->products->sum('line_total') * ((100+$product->invoice->client->tax_rate) / 100),
                'balance'=> $product->invoice->products->sum('line_total') * ((100+$product->invoice->client->tax_rate) / 100)
                    - $product->invoice->discount
                    - $product->invoice->payments->sum('payment_amount')));
        }elseif($product->invoice->discount_type == 'Percent'){
            Invoice::where('id',$product->invoice_id)->update(array(
                'amount'=>  $product->invoice->products->sum('line_total') * ((100+$product->invoice->client->tax_rate) / 100),
                'balance'=> $product->invoice->products->sum('line_total') * ((100-$product->invoice->discount) / 100)+
                    ( $product->invoice->products->sum('line_total')
                        *  (100+$product->invoice->client->tax_rate) / 100)
                    -$product->invoice->products->sum('line_total')
                    -$product->invoice->payments->sum('payment_amount'),
            ));
        }
        return redirect('admin/invoices/'.$product->invoice_id.'/edit/');
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
    public function edit(Product $product)
    {
        //
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $product->update($request->all());
        $product->line_total = $product->unit_cost * $product->quantity;
        $product->save();
        if($product->invoice->discount_type == 'Amount') {
            Invoice::where('id',$product->invoice_id)->update(array(
                'amount'=> $product->invoice->products->sum('line_total') * ((100+$product->invoice->client->tax_rate) / 100),
                'balance'=> $product->invoice->products->sum('line_total') * ((100+$product->invoice->client->tax_rate) / 100)
                    - $product->invoice->discount
                    - $product->invoice->payments->sum('payment_amount')));
        }elseif($product->invoice->discount_type == 'Percent'){
            Invoice::where('id',$product->invoice_id)->update(array(
                'amount'=>  $product->invoice->products->sum('line_total') * ((100+$product->invoice->client->tax_rate) / 100),
                'balance'=> $product->invoice->products->sum('line_total') * ((100-$product->invoice->discount) / 100)+ ( $product->invoice->products->sum('line_total') *  (100+$product->invoice->client->tax_rate) / 100) -$product->invoice->products->sum('line_total')-$product->invoice->payments->sum('payment_amount'),
            ));
        }
        return redirect('admin/invoices/'.$product->invoice_id.'/edit/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ids
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        if($product->invoice->discount_type == 'Amount') {
            Invoice::where('id',$product->invoice_id)->update(array(
                'amount'=> $product->invoice->products->sum('line_total') * ((100+$product->invoice->client->tax_rate) / 100),
                'balance'=> $product->invoice->products->sum('line_total') * ((100+$product->invoice->client->tax_rate) / 100)
                    - $product->invoice->discount
                    - $product->invoice->payments->sum('payment_amount')));
        }elseif($product->invoice->discount_type == 'Percent'){
            Invoice::where('id',$product->invoice_id)->update(array(
                'amount'=>  $product->invoice->products->sum('line_total') * ((100+$product->invoice->client->tax_rate) / 100),
                'balance'=> $product->invoice->products->sum('line_total') * ((100-$product->invoice->discount) / 100)+ ( $product->invoice->products->sum('line_total') *  (100+$product->invoice->client->tax_rate) / 100) -$product->invoice->products->sum('line_total')-$product->invoice->payments->sum('payment_amount'),
            ));
        }
        return redirect()->back();
    }
}
