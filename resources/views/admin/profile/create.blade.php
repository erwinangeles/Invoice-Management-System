@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.profile.store')}}" enctype="multipart/form-data">
    <div class="container">
        <h1>Create Profile (Your Business Information)</h1>
        <div class="row" style="padding-top: 10px">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Your Business Info)</div>

                    <div class="card-body">
                            @csrf
                        Business Name:
                        <input type="text" name="business_name" class="form-control"/>
                            Street Address:
                            <input type="text" name="business_address_street" class="form-control"/>
                            Apartment/Suite:
                            <input type="text" name="business_address_street2" class="form-control"/>
                            City:
                            <input type="text" name="business_address_city" class="form-control"/>
                            State:
                            <input type="text" name="business_address_state" class="form-control"/>
                            Zip Code:
                            <input type="text" name="business_address_zipcode" class="form-control"/>
                            Email:
                            <input type="text" name="business_email" class="form-control"/>
                            Phone Number:
                            <input type="text" name="business_phone_number" class="form-control"/>
                           Website:
                            <input type="text" name="business_website" class="form-control"/>
                            Header Notes:
                            <textarea type="text" name="header_notes" class="form-control"></textarea>
                            Footer Notes - Left:
                            <textarea type="text" name="footer_notes_left" class="form-control"></textarea>
                            Footer Notes - Right:
                            <textarea type="text" name="footer_notes_right" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Preview</div>
                    <div class="card-body">
                        Logo Image:
                        <br>
                        <input type="file" id="business_logo" name = "business_logo">
                        <br><br>
                        <input type="submit" value="Save" class="btn btn-primary">
                    </div>
                </div>
                </div>
            </div>
    </div>
    </form>
@endsection
