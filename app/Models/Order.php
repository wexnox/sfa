<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['cart'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
