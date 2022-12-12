<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'address',
        'barangay_id',
    ];


    const TYPE_ADMIN = 'Administrator';
    const TYPE_SUPPLIER = 'Supplier';
    const TYPE_CUSTOMER = 'Customer';

    public function barangay () {
        return $this->belongsTo(Barangay::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cartItems() {
        return $this->hasMany(CartItem::class, 'user_id');
    }

    public function getTotalProductAttribute() {
        $total = 0;
        foreach ($this->cartItems as $item) {
            $total += ($item->quantity * $item->product->selling_price);
        }

        return $total;
    }

    public function getGrandTotalAttribute() {

        $shipping = $this->shippingFee;
        return $this->total_product + $shipping;
    }

    public function getShippingFeeAttribute() {
        try {
            $fee = $this->barangay->address->shipping_cost;

            return $fee;
        } catch (Exception $e) {
            return 50; // default
        }
    }
}
