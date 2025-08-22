<?php

namespace Database\Seeders;

use App\Models\User;
use App\UserStatus;
use App\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=> 'Veerin',
            'username'=> 'veerin309',
            'email'=> 'veerin@gmail.com',
            'password'=> Hash::make('veerin123'),
            'type'=>UserType::User,
            'status'=>UserStatus::Active,
        ]);
    }
}
