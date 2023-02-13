<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmittedRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainee_id',
        'file',
        'task_id',
        'remarks',
    ];

    public function trainee () {
        return $this->belongsTo(Trainee::class);
    }

    public function task() {
        return $this->belongsTo(Task::class);
    }
}
