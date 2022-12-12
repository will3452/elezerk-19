<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
       'company_id',
       'raw',
       'name',
       'category',
       'productId',
       'description',
       'brand_id',
       'image',
       'uom',
       'quantity',
       'unit_cost',
       'product_cost',
       'selling_price',
       'user_id',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function brand () {
        return $this->belongsTo(Brand::class);
    }

    public function reviews () {
        return $this->hasMany(Review::class, 'product_id');
    }
}
