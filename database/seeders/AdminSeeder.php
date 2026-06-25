<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::updateOrCreate(
            ['username' => 'admin_satu'],
            [
                'name' => 'Admin',
                'password' => bcrypt('123456'),
                'role' => 'admin'
            ]
        );
    }
}