@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.profile.update', $profile->id)}}" enctype="multipart/form-data">
        {{method_field('PUT')}}
        @csrf
        <div class="container">
            <h1>Edit Profile</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Profile Information</div>

                        <div class="card-body">
<strong>To preview what the invoice would look like, <a href="/admin/invoice/preview" target="_blank">click here</a> </strong>
                            <hr>
                            Business Name:
                            <input type="text" value="{{$profile->business_name}}" name="business_name" class="form-control"/>
                            Street Address:
                            <input type="text" value="{{$profile->business_address_street}}" name="business_address_street" class="form-control"/>
                            Apartment/Suite:
                            <input type="text" value="{{$profile->business_address_street2}}" name="business_address_street2" class="form-control"/>
                            City:
                            <input type="text" value="{{$profile->business_address_city}}" name="business_address_city" class="form-control"/>
                            State:
                            <input type="text" value="{{$profile->business_address_state}}" name="business_address_state" class="form-control"/>
                            Zip Code:
                            <input type="text" value="{{$profile->business_address_zipcode}}" name="business_address_zipcode" class="form-control"/>

                            <img src="{{url('/images/')}}/{{ $profile->business_logo }}" style="width:100%; max-width:300px;"/>
                            <input type="file" id="business_logo" name = "business_logo">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Contact Information</div>

                        <div class="card-body">
                            Email:
                            <input type="text" value="{{$profile->business_email}}" name="business_email" class="form-control"/>
                            Phone Number:
                            <input type="text" value="{{$profile->business_phone_number}}" name="business_phone_number" class="form-control"/>
                            Website:
                            <input type="text" value="{{$profile->business_website}}" name="business_website" class="form-control"/>

                            Header Notes:
                            <textarea type="text" name="header_notes" class="form-control">{{$profile->header_notes}}</textarea>
                            Footer Notes - Left:
                            <textarea type="text" name="footer_notes_left" class="form-control">{{$profile->footer_notes_left}}</textarea>
                            Footer Notes - Right:
                            <textarea type="text" name="footer_notes_right" class="form-control">{{$profile->footer_notes_right}}</textarea>
                        <br>
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>

            </div>
    </form>
@endsection
