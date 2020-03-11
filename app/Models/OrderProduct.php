<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['product_id', 'order_id', 'price', 'amount', 'days', 'status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    public function getPriceAttribute($value)
    {
        return floatval($value / 100);
    }
}
