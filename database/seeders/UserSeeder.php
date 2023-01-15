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
        User::create([
            'email' => 'super@admin.com',
            'password' => bcrypt('password'),
            'name' => 'Administrator',
            'type' => User::TYPE_ADMIN,
        ]);
    }
}
