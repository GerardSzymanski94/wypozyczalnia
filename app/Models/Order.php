<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_price', 'date_from', 'date_to', 'status'];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');

    }

    public function price()
    {
        $price = 0;
        foreach ($this->orderProducts as $orderProduct) {
            if (isset($orderProduct->price) && $orderProduct->price != null)
                $price = $price + $orderProduct->price;
        }
        return $price;
    }
}
