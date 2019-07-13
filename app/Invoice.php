<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $fillable = ['client_id',
        'invoice_number', 'invoice_date',
        'po_number', 'amount', 'balance',
        'due_date',  'deposit_amount','discount',
        'discount_type','private_notes','status'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');

    }
    public function products()
    {
        return $this->hasMany('App\Product');

    }
    public function payments()
    {
        return $this->hasMany('App\Payment');

    }
}
