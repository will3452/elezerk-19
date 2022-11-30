<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'request_type_id',
        'user_id',
        'status',
        'description',
        'attachments',
    ];

    const STATUS_PENDING = 'Pending';
    const STATUS_APPROVED = 'Approved';
    const STATUS_DECLINED = 'Declined';

    public function requestType () {
        return  $this->belongsTo(RequestType::class, 'request_type_id');
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
