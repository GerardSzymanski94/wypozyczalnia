<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['baselinker_key', 'status_id', 'baselinker_deposit_id', 'turn_on_baselinker'];
}
