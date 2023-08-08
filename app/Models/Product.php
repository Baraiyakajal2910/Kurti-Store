<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

     protected $fillable = [
        'brand_id','color_id','upc','name','access_url','description','price','stock',
    ];
}
