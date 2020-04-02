<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'short_description', 'status', 'amount', 'available', 'price_more_month', 'price_four_week', 'price_three_week',
        'price_two_week', 'price_one_week', 'deposit', 'baselinker_id', 'sku', 'ean'];

    public function getMainPhoto()
    {
        return $this->hasOne(Image::class, 'product_id', 'id');
    }

    public function setDepositAttribute($value)
    {
        $this->attributes['deposit'] = $value * 100;
    }

    public function getDepositAttribute($value)
    {
        return floatval($value / 100);
    }

    public function setPriceOneWeekAttribute($value)
    {
        $this->attributes['price_one_week'] = $value * 100;
    }

    public function getPriceOneWeekAttribute($value)
    {
        return floatval($value / 100);
    }

    public function setPriceTwoWeekAttribute($value)
    {
        $this->attributes['price_two_week'] = $value * 100;
    }

    public function getPriceTwoWeekAttribute($value)
    {
        return floatval($value / 100);
    }

    public function setPriceThreeWeekAttribute($value)
    {
        $this->attributes['price_three_week'] = $value * 100;
    }

    public function getPriceThreeWeekAttribute($value)
    {
        return floatval($value / 100);
    }

    public function setPriceFourWeekAttribute($value)
    {
        $this->attributes['price_four_week'] = $value * 100;
    }

    public function getPriceFourWeekAttribute($value)
    {
        return floatval($value / 100);
    }

    public function setPriceMoreMonthAttribute($value)
    {
        $this->attributes['price_more_month'] = $value * 100;
    }

    public function getPriceMoreMonthAttribute($value)
    {
        return floatval($value / 100);
    }

    public function price($days, $amount = 1)
    {

        $price = 0;
        if ($days > 28) {
            $price = $this->price_more_month * $days;
        } elseif ($days > 21) {
            $price = $this->price_four_week * $days;
        } elseif ($days > 14) {
            $price = $this->price_three_week * $days;
        } elseif ($days > 7) {
            $price = $this->price_two_week * $days;
        } else {
            $price = $this->price_one_week * $days;
        }

        return $price * $amount;
    }

    public function priceAdditional($amount = 1)
    {
        return $this->price_one_week * $amount;
    }

    public function reduceAmount($value)
    {
        $this->amount = $this->amount - $value;
        $this->save();
    }

    public function increaseAmount($value)
    {
        $this->amount = $this->amount + $value;
        $this->save();
    }

    public function checkAmount($amount)
    {
        if ($this->amount >= $amount) {
            return true;
        } else {
            return false;
        }
    }
}
