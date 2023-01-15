<?php

namespace App\Observers;

use App\Models\Trainee;
use App\Models\User;

class TraineeObserver
{
    public function creating(Trainee $trainee) {
        $user = User::create([
            'name' => $trainee->last_name. ", ". $trainee->first_name. " " . $trainee->middle_name . ".",
            'email' => $trainee->email,
            'password' => bcrypt('IT81-OCM'),
            'type' => User::TYPE_TRAINEE,
        ]);

        $trainee->user_id = $user->id;
    }
}
