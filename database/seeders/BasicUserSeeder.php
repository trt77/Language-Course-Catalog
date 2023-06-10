<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class BasicUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('testtest'),
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
