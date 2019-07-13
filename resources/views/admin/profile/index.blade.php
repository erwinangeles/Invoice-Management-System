@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Clients</div>

                    <div class="card-body">
                        <a href="{{route('admin.clients.create')}}" class="btn btn-sm btn-primary">Add new</a>
                        <br/> <br/>

                        <table class="table table-responsive-sm">
                            <thead>
                                <th>Business Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Created</th>
                                <th>Balance</th>
                                <th></th>
                            </thead>
                            <tbody>
                            @forelse($clients as $client)

                                <tr>
                                    <td>{{$client->business_name}}</td>
                                    <td>{{$client->first_name}} {{$client->last_name}}</td>
                                    <td>{{$client->email_address}}</td>
                                    <td>{{$client->created_at->format('m-d-y')}}</td>
                                    <td>${{number_format($client->invoices->sum('balance'), 2)}}</td>
                                    <td> <a href="{{ route('admin.clients.show', $client->id) }}" class="btn btn-sm btn-primary">View</a>
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
