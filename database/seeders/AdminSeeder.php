<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'administrator',
            'type' => User::TYPE_ADMIN,
            'email' => 'super@admin.com',
            'password' => bcrypt('password'),
            'address' => null,
            'barangay_id' => null
        ]);
    }
}
