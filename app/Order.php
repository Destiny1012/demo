<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $fillable = [
        "number", "goods", "total", "user",
    ];
}
