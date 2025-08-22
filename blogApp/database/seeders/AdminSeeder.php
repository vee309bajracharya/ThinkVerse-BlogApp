<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@thinkverse.com',
            'username' => 'admin_thinkverse',
            'password' => Hash::make('ThinkVerse309'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
