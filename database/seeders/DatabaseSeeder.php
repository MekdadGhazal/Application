<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\AdminFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Mekdad',
            'email' => 'admin@morty.net',
            'email_verified_at' => now(),
            'password' => Hash::make('00225588'),
            'remember_token' => Str::random(10),
            'phone' => Str::random(10),
            'city' => Str::random(10),
            'bank' => Str::random(10),
            'card' => Str::random(10),
            'location' => Str::random(10),
            'image'=>fake()->imageUrl,
            'located'=> fake()->imageUrl ,
            'verify' => 1
        ]);

        \App\Models\Admin::create([
            'user_id' => 1,
            ]);

        \App\Models\User::factory(10)->create();

    }
}
