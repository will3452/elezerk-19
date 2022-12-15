<?php

namespace App\Models\Traits;

use App\Models\User;

trait HasUser {
    public function user () {
        return $this->belongsTo(User::class);
    }

    public static function boot() {
        parent::boot();
        static::saving(function ($model) {
            $model->user_id = auth()->id();
        });
    }
}
