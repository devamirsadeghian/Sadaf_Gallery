<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'name' => 'ادمین 1',
            'user_name' => '',
            'mobile' => '09960120095',
            'password' => Hash::make('11111'),
            'is_admin' => 1
        ]);

        User::updateOrCreate([
            'name' => 'ادمین 2',
            'user_name' => '',
            'mobile' => '09960120096',
            'password' => Hash::make('22222'),
            'is_admin' => 1
        ]);
    }
}


