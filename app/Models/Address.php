<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
       'country',
       'region',
       'province',
       'municipality',
       'shipping_cost',
       'postal_code',
       'lat',
       'lng',
    ];
}
