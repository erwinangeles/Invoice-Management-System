<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = ['business_name',
        'first_name', 'last_name', 'email_address',
        'phone_number', 'address_street', 'address_street2',
        'address_city', 'address_state', 'address_zipcode', 'tax_rate', 'private_notes'
    ];

    public function invoices()
    {
        return $this->hasMany('App\Invoice');

    }
    public function payments()
    {
        return $this->hasMany('App\Payment');

    }
}
