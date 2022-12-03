<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $fillable = [
        'four_ps',
        'nhts',
        'dialec',
        'type_of_dwelling',
        'type_of_electricity',
        'source_of_water',
        'sanitation_facilities',
        'name',
    ];
}
