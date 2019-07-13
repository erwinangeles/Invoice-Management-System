@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.products.update', $product->id)}}">
        {{method_field('PUT')}}
        @csrf
        <div class="container">
            <h1>Edit Invoice</h1>
            <div class="row" style="padding-top: 10px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Edit Invoice</div>
                        <div class="card-body">
                            Invoice Number:
                            <input type="text" name="invoice_number"  value="{{$product->invoice->invoice_number}}" class="form-control" disabled/>
                            Product Name:
                            <input type="text" name="item_name" value="{{$product->item_name}}" class="form-control"/>
                            Description:
                            <textarea type="text" name="item_description" class="form-control">{{$product->item_description}}</textarea>
                            Unit Cost:
                            <input type="text" name="unit_cost" value="{{$product->unit_cost}}" class="form-control"/>
                            Quantity
                            <input type="text" name="quantity" value="{{$product->quantity}}" class="form-control"/>
                            <br>
                            <input type="submit" value="Save" class="btn btn-primary">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
