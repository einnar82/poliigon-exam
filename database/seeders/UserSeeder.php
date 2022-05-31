<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'id' => 1,
                'name' => "Arisha Barron",
                'email' => 'arisha@email.com',
                'email_verified_at' => now(),
                'password' => \bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => "Branden Gibson",
                'email' => 'branden@email.com',
                'email_verified_at' => now(),
                'password' => \bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => "Rhonda Church",
                'email' => 'rhonda@email.com',
                'email_verified_at' => now(),
                'password' => \bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => "Georgina Hazel",
                'email' => 'georgina@email.com',
                'email_verified_at' => now(),
                'password' => \bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        User::insert($users);
    }
}
