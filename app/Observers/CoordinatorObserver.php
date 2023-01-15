<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Coordinator;

class CoordinatorObserver
{
    public function creating(Coordinator $coordinator) {
        $user = User::create([
            'name' => $coordinator->last_name. ", ". $coordinator->first_name. " " . $coordinator->middle_name[0] . ".",
            'email' => $coordinator->email,
            'password' => bcrypt('IT81-OCM'),
            'type' => User::TYPE_COORDINATOR,
        ]);

        $coordinator->user_id = $user->id;
    }
}
