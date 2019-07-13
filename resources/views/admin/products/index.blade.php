@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Products</div>

                    <div class="card-body">
                        <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-primary">Add new</a>
                        <br/> <br/>

                        <table class="table table-responsive-sm">
                            <thead>
                                <th>Invoice Number</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Unit Cost</th>
                                <th></th>
                            </thead>
                            <tbody>
                            @forelse($products as $product)

                                <tr>
                                <td>{{$product->invoice->invoice_number}}</td>
                                    <td>{{$product->item_name}}</td>
                                    <td>{{$product->item_description}}</td>
                                    <td>${{number_format($product->unit_cost, 2)}}</td>
                                    <td> <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="2">No records found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
