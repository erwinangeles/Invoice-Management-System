@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.payments.update', $payment->id)}}">
        {{method_field('PUT')}}
        @csrf
        <div class="container">
            <h1>Edit Payment Entry</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Payment Information</div>

                        <div class="card-body">
                            Payment Amount:
                            <input type="text" name="payment_amount"  value="{{$payment->payment_amount}}" class="form-control"/>
                            Payment Type:
                            <select class="form-control" id="payment_type" name="payment_type">
                                <option value="Cash">Cash</option>
                                <option value="Check">Check</option>
                                <option value="Money Order">Money Order</option>
                                <option value="Debit Card">Debit Card</option>
                                <option value="Credit Card Other">Credit Card Other</option>
                            </select>
                            Payment Date:
                            <input type="date" name="payment_date" value="{{ $payment->payment_date  }}" class="form-control"/>
                            Transaction Reference:
                            <input type="text" value="{{$payment->transaction_reference}}" name="transaction_reference" class="form-control"/>
                            Private Notes:
                            <textarea name="private_notes" class="form-control">{{$payment->private_notes }}</textarea>
                            <br>
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
