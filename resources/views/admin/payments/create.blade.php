@extends('layouts.app')

@section('content')

    <form method="POST" action="{{route('admin.payments.store')}}">
        <div class="container">
            <h1>Create Invoice</h1>
            <div class="row" style="padding-top: 10px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Payment Information</div>

                        <div class="card-body justify-content-center">
                            @csrf
                            Client:
                            <select class="form-control" id="client_id" name="client_id">
                                @forelse(App\Client::all() as $client)
                                    <option value="{{$client->id}}">{{$client->first_name}} {{$client->last_name}}</option>
                                @empty
                                @endforelse
                            </select>
                            Invoice:
                            <select class="form-control" id="invoice_id" name="invoice_id">
                                @forelse(App\Invoice::all() as $invoice)
                                    <option value="{{$invoice->id}}">{{$invoice->invoice_number}} - {{$invoice->client->first_name}} {{$invoice->client->last_name}} - ${{number_format($invoice->balance, 2)}} | ${{number_format($invoice->amount, 2)}} </option>
                                @empty
                                @endforelse
                            </select>
                            Payment Amount:
                            <input type="text" name="payment_amount" class="form-control"/>
                            Payment Type:
                            <select class="form-control" id="payment_type" name="payment_type">
                                <option value="Cash">Cash</option>
                                <option value="Check">Check</option>
                                <option value="Money Order">Money Order</option>
                                <option value="Debit Card">Debit Card</option>
                                <option value="Credit Card Other">Credit Card Other</option>
                            </select>
                            Payment Date:
                            <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" class="form-control"/>
                            Transaction Reference:
                            <input type="text" name="transaction_reference" class="form-control"/>
                            Private Notes:
                            <textarea name="private_notes" class="form-control"></textarea>
                            <br>
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
