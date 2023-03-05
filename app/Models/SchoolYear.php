<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;

    public static function default() {
        return self::whereDefault(1)->first();
    }

    protected $fillable = [
        'from',
        'to',
        'default',
    ];
}
