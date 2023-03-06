<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;

    public static function default() {
        try {
            return self::whereDefault(1)->first();
        } catch (Exception $e) {
            return null;
        }

    }

    protected $fillable = [
        'from',
        'to',
        'default',
    ];
}
