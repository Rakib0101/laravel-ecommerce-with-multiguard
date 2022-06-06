<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'admin',
            'phone' => '01644229013',
            'email' => 'admin@mail.com',
            'email_verified_at' => null,
            'password' => Hash::make('111111')
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'email_verified_at' => null,
            'password' => Hash::make('111111')
        ]);
    }
}
