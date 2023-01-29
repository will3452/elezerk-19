<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
                [
                    'name' => 'Juan D Owner',
                    'email' => 'juan@mail.com',
                    'password' => bcrypt('password'),
                    'type' => User::TYPE_OWNER,
                ],
                [
                    'name' => 'The Administrator',
                    'email' => 'super@admin.com',
                    'password' => bcrypt('password'),
                    'type' => User::TYPE_ADMIN,
                ]
            ];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
