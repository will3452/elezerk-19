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
            'name' => 'Rowald Razon',
            'email' => 'super@admin.com',
            'password' => bcrypt('password'),
            'type' => User::TYPE_ADMIN,
        ]);

        error_log('username: super@admin.com, password: password');
    }
}
