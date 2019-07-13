@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.clients.store')}}">
    <div class="container">
        <h1>Create Client</h1>
        <div class="row" style="padding-top: 10px">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Contact Information</div>

                    <div class="card-body">
                            @csrf
                        Business Name:
                        <input type="text" name="business_name" class="form-control"/>
                            First Name:
                            <input type="text" name="first_name" class="form-control"/>
                            Last Name:
                            <input type="text" name="last_name" class="form-control"/>
                            Email:
                            <input type="text" name="email_address" class="form-control"/>
                            Phone Number:
                            <input type="text" name="phone_number" class="form-control"/>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Address</div>
                    <div class="card-body">
                       Street Address:
                        <input type="text" name="address_street" class="form-control"/>
                        Apartment/Suite:
                        <input type="text" name="address_street2" class="form-control"/>
                        City:
                        <input type="text" name="address_city" class="form-control"/>
                        State:
                        <input type="text" name="address_state" class="form-control"/>
                        Zip Code:
                        <input type="text" name="address_zipcode" class="form-control"/>
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
                        <input type="text" name="tax_rate" value="8.25" class="form-control"/>
                        <br>
        <input type="submit" value="Save" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
