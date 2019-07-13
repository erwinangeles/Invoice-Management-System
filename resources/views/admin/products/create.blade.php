@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.products.store')}}" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <h1>Create Product</h1>
        <div class="row" style="padding-top: 10px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Product Information</div>

                    <div class="card-body">

                            @csrf
                        <select class="form-control" id="invoice_id" name="invoice_id" <?php if (app('request')->input('invoice_id')) echo ' disabled'; ?>>
                            @forelse(App\Invoice::all() as $invoice)
                                <option value="{{$invoice->id}}" <?php if (app('request')->input('invoice_id') == $invoice->id) echo ' selected="selected"'; ?>>{{$invoice->invoice_number}}</option>
                            @empty
                            @endforelse
                        </select>
                            Item Name:
                            <input type="text" name="item_name" class="form-control"/>
                            Description:
                        <textarea type="text" name="item_description" class="form-control"></textarea>
                            Unit Cost:
                            <input type="text" name="unit_cost" class="form-control"/>
                        Quantity:
                        <input type="text" name="quantity" class="form-control"/>
                        <br>
                        <input type="submit" value="Save" class="btn btn-primary">
                    </div>
                </div>
            </div>

            </div>
    </div>
    </form>
@endsection
