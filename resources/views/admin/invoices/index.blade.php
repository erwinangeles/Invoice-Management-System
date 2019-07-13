@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Invoices</div>

                    <div class="card-body">
                        <a href="{{route('admin.invoices.create')}}" class="btn btn-sm btn-primary">Create New Invoice</a>
                        <br/> <br/>

                        <table class="table table-responsive-sm">
                            <thead>
                                <th>Invoice Number</th>
                                <th>Client Name</th>
                                <th>Amount</th>
                                <th>Balance</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th></th>
                            </thead>
                            <tbody>
                            @forelse($invoices as $invoice)

                                <tr>
                                    <td>{{$invoice->invoice_number}}</td>
                                    <td>{{$invoice->client->first_name}} {{$invoice->client->last_name}}</td>
                                    <td>${{number_format($invoice->amount, 2)}}</td>
                                    <td>${{number_format($invoice->balance, 2)}}</td>
                                    <td>  <?php if ($invoice->due_date ==! null) echo date("F d, Y", strtotime($invoice->due_date));?></td>
                                    <td><span class="label label-success">{{$invoice->status}}</span></td>
                                    <td> <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="btn btn-sm btn-primary">View</a>
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
