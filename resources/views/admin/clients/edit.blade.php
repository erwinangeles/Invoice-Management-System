@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.clients.update', $client->id)}}">
        {{method_field('PUT')}}
        @csrf
        <div class="container">
            <h1>Edit Client</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Contact Information</div>

                        <div class="card-body">
                            Business Name:
                            <input type="text" name="business_name" value="{{$client->business_name}}" class="form-control"/>
                            First Name:
                            <input type="text" name="first_name" value="{{$client->first_name}}" class="form-control"/>
                            Last Name:
                            <input type="text" name="last_name" value="{{$client->last_name}}" class="form-control"/>
                            Email:
                            <input type="text" name="email_address" value="{{$client->email_address}}" class="form-control"/>
                            Phone Number:
                            <input type="text" name="phone_number" value="{{$client->phone_number}}" class="form-control"/>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Address</div>
                        <div class="card-body">
                            Street Address:
                            <input type="text" name="address_street" value="{{$client->address_street}}" class="form-control"/>
                            Apartment/Suite:
                            <input type="text" name="address_street2" value="{{$client->address_street2}}" class="form-control"/>
                            City:
                            <input type="text" name="address_city" value="{{$client->address_city}}" class="form-control"/>
                            State:
                            <input type="text" name="address_state"  value="{{$client->address_state}}" class="form-control"/>
                            Zip Code:
                            <input type="text" name="address_zipcode" value="{{$client->address_zipcode}}" class="form-control"/>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Additional Information</div>
                        <div class="card-body">
                            Tax Rate:
                            <input type="text" name="tax_rate" value="{{$client->tax_rate}}" class="form-control"/>
                            Notes (Private):
                            <textarea name="private_notes" class="form-control">{{$client->private_notes}}</textarea>
                            <br>
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
