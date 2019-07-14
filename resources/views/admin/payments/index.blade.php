@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Payments</div>

                    <div class="card-body">
                        <a href="{{route('admin.payments.create')}}" class="btn btn-sm btn-primary">Add new Payment</a>
                        <br/> <br/>

                        <table class="table table-responsive-sm">
                            <thead>
                            <th>Client Name</th>
                            <th>Transaction Reference</th>
                            <th>Method</th>
                            <th>Source</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @forelse($payments as $payment)

                                <tr>
                                    <td>{{$payment->invoice->client->first_name}} {{$payment->invoice->client->last_name}}</td>
                                    <td>{{$payment->transaction_reference}}</td>
                                    <td><em>Manual Entry</em></td>
                                    <td>{{$payment->payment_type}}</td>
                                    <td>${{number_format($payment->payment_amount,2)}}</td>
                                    <td> <?php if ($payment->payment_date ==! null) echo date("F d, Y", strtotime($payment->payment_date));?></td>
                                    <td>{{$payment->status}}</td>
                                    <td> <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form method="POST" action="{{route('admin.payments.destroy', $payment->id)}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <input type="submit" value="Delete" class="btn btn-sm btn-danger" />
                                        </form>
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
