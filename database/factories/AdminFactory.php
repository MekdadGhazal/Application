<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
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
        ];
    }
}
