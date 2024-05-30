<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make(123456789),
            'role' => 1,
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'username' => 'jay',
            'password' => Hash::make(123456789),
        ]);
    }
}
