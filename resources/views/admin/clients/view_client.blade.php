@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Client  <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-primary btn-info">Edit</a></div>
                    <div class="card-body">
                        <h2>Details</h2>
                       {{$client->business_name}}<br>
                        {{$client->first_name}} {{$client->last_name}}<br>
                        {{$client->email_address}}<br>
                        {{$client->phone_number}}<br>
                        <h2>Address</h2>
                        {{$client->address_street}}<br>
                        {{$client->address_street2}}<br>
                        {{$client->address_city}}, {{$client->address_state}}, {{$client->address_zipcode}}
                        <h2>Standings</h2>
                        Paid to Date: ${{number_format($client->payments->sum('payment_amount'), 2)}}<br>
                        Balance: ${{number_format($client->invoices->sum('balance'), 2)}}
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Invoices</div>

                    <div class="card-body">
                        <table class="table table-responsive-sm">
                            <thead>
                            <th>Invoice Number</th>
                            <th>Client Name</th>
                            <th>Amount Due</th>
                            <th>Balance</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @forelse($client->invoices as $invoice)

                                <tr>
                                    <td>{{$invoice->invoice_number}}</td>
                                    <td>{{$invoice->client->first_name}} {{$invoice->client->last_name}}</td>
                                    <td>${{number_format($invoice->amount, 2)}}</td>
                                    <td>${{number_format($invoice->balance, 2)}}</td>
                                    <td>{{$invoice->due_date}}</td>
                                    <td>{{$invoice->status}}</td>
                                    <td><a href="{{ route('admin.invoices.edit', $invoice->id) }}" target="_blank" class="btn btn-sm btn-warning">View Invoice</a>
                                        <a href="{{ route('admin.invoices.generate-pdf',$invoice->id, ['download'=>'pdf']) }}" target="_blank" class="btn btn-sm btn-info">Download</a>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="2">No records found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <a href="{{route('admin.invoices.create')}}" class="btn btn-sm btn-primary">Create New Invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
