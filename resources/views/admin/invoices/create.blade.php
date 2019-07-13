@extends('layouts.app')

@section('content')

    <form method="POST" action="{{route('admin.invoices.store')}}">
    <div class="container">
        <h1>Create Invoice</h1>
        <div class="row" style="padding-top: 10px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Invoice Information</div>

                    <div class="card-body justify-content-center">
                            @csrf
                            Client:
                        <select class="form-control" id="client_id" name="client_id" <?php if (app('request')->input('client_id')) echo ' disabled'; ?>>
                            @forelse(App\Client::all() as $client)
                               <option value="{{$client->id}}" <?php if (app('request')->input('client_id') == $client->id) echo ' selected="selected"'; ?>>{{$client->first_name}} {{$client->last_name}}</option>
                               @empty
                            @endforelse
                        </select>
                            Invoice Number:
                            <input type="text" name="invoice_number" value="0000{{$client->invoices->count()+1}}" class="form-control"/>
                            Invoice Date:
                            <input type="date" name="invoice_date" value="{{ date('Y-m-d') }}" class="form-control"/>
                            Due Date:
                            <input type="date" name="due_date" class="form-control"/>
                            <input type="text" name="discount" class="form-control" hidden/>
                        <select class="form-control" id="discount_type" name="discount_type" hidden>
                      <option value="Amount">Amount</option>
                            <option value="Percent">Percent</option>
                        </select>
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
