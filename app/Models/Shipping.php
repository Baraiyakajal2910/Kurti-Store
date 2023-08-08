<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shipping_address';

     protected $fillable = [
        'user_id', 'name','email','mobile', 'address', 'city', 'state', 'pincode',
    ];
}
