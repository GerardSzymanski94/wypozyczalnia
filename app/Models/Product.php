<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'short_description', 'status', 'amount', 'available', 'price_more_month', 'price_four_week', 'price_three_week',
        'price_two_week', 'price_one_week'];

    public function getMainPhoto()
    {
        return $this->hasOne(Image::class, 'product_id', 'id');
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
}
