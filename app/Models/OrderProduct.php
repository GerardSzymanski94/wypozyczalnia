<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['product_id', 'order_id', 'price', 'amount', 'amount_additional', 'days', 'status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    public function getPriceAttribute($value)
    {
        return floatval($value / 100);
    }

    public function changeStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function showStatus()
    {
        switch ($this->status) {
            case 1:
                return 'Niedokończone';
                break;
            case 2:
                return 'Wysłane';
                break;
            case 3:
                return 'Zwrócone';
                break;
            case 4:
                return 'Niezwrócone';
                break;
            default:
                return 'Nieznany status';
        }
    }

    public function showDay()
    {
        $date = Carbon::parse($this->created_at);
        $date->addDays($this->days);
        return $date->format('d-m-Y');
    }
}
