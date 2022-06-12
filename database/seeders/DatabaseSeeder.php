<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Slider;
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

        \App\Models\Category::factory(10)->create();
        \App\Models\SubCategory::factory(20)->create();
        \App\Models\ChildCategory::factory(50)->create();
        \App\Models\Brand::factory(10)->create();
        \App\Models\Product::factory(40)->create();
        \App\Models\Slider::factory(3)->create();
        \App\Models\ProductGallery::factory(200)->create();
    }
}
