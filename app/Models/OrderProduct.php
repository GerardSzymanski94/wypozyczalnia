<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['product_id', 'order_id', 'price', 'amount', 'amount_additional', 'days', 'status',
        'parent_id', 'deposit', 'days_to_return', 'start_date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function additionals()
    {
        return $this->hasMany(OrderProduct::class, 'parent_id', 'id');
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
            case 5:
                return 'Przedłużono';
                break;
            default:
                return 'Nieznany status';
        }
    }

    public function showDay()
    {
        if ($this->product->status == 2) {
            return "";
        }


        $date = Carbon::parse($this->start_date);

        if (!is_null($this->days)) {
            $date->addDays($this->days);
        } else {
            $date->addDays($this->days);
        }
        return $date->format('d-m-Y');
    }
}
