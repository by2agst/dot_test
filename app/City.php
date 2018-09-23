<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'city_id';
	protected $fillable   = ['city_id', 'province_id', 'type', 'city_name', 'postal_code'];
}
