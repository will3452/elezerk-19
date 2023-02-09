<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory, HasUser;

    protected $fillable = [
       'category',
       'title',
       'description',
       'attachments',
       'status',
       'user_id',
       'type',
    ];

    const STATUS_DONE = 'DONE';
    const STATUS_ACTIVE = 'ACTIVE';

    public function accesses () {
        return $this->hasMany(Access::class);
    }

}
