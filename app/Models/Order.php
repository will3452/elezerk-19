<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id',
       'status',
       'address',
       'shipping_cost',
       'total',
       'mop',
       'done',
       'reference',
       'supplier_id', // for supplier features
    ];

    public function user () { // client
        return $this->belongsTo(User::class);
    }

    public function supplier () {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    public function orderItems () {
        return $this->hasMany(OrderItem::class);
    }

    const MOP_COD = 'COD';
    const MOP_GCASH = 'GCASH';

    const STATUS_DONE = 'Done';
    const STATUS_PENDING = 'Pending';
    const STATUS_CANCELLED = 'Cancelled';
    const STATUS_FOR_DELIVERY = 'Delivery';
}
