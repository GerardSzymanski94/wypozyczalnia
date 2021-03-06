<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total_price', 'date_from', 'date_to', 'status', 'session_key', 'invoice', 'order', 'delivery_id',
        'delivery_additional', 'delivery_price', 'delivery_address', 'delivery_city', 'send'];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id')->with('product');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function price()
    {
        $price = 0;
        foreach ($this->orderProducts as $orderProduct) {
            if (isset($orderProduct->price) && $orderProduct->price != null)
                $price = $price + $orderProduct->price + $orderProduct->deposit;
        }
        if (isset($this->delivery)) {
            $price += $this->delivery->price;
        }
        return $price;
    }

    public function setDeliveryPriceAttribute($value)
    {
        $this->attributes['delivery_price'] = $value * 100;
    }

    public function getDeliveryPriceAttribute($value)
    {
        return floatval($value / 100);
    }

    public function showStatus()
    {
        switch ($this->status) {
            case 1:
                return 'Niedokończone';
                break;
            case 2:
                return 'Zamówienie dokończone';
                break;
            case 3:
                return 'Częściowo zwrócone';
                break;
            case 4:
                return 'Zwrócone';
                break;
            default:
                return 'Nieznany status';
        }
    }


    public function changeStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function checkAmounts()
    {
        foreach ($this->orderProducts as $orderProduct) {
            if ($orderProduct->product->checkAmount($orderProduct->amount) == false)
                return false;
        }
        return true;
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id', 'id');
    }
}
