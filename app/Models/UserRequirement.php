<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'model_id',
        'name',
        'file',
    ];

    public function model () {
        return $this->morphTo();
    }
}
