<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['product_id', 'order_id', 'price', 'amount', 'days'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
