<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'first_name' => 'Ziad',
            'last_name' => 'Ahmed',
            'email' => 'ziad@example.com',
            'password' => bcrypt('password123'), // كلمة سر مؤقتة
            'role' => 'student'
        ]);
    }
}
