<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $table = 'brands';

     protected $fillable = [
        'name',
    ];
}
