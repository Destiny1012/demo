<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $fillable = [
        'name', 'image', 'price', 'sale', 'description', 'surplus', 'sold', 'catalog',
    ];
}
