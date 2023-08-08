<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

     protected $fillable = [
        'user_id','status','shipping_id','billing_id','total_qty','total_price',
    ];
}
