<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['invoice_id',
        'item_name', 'item_description', 'unit_cost',
        'quantity','line_total',
    ];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');

    }
}
