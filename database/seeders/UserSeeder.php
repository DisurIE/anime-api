<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Framework\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\UniqueConstraintViolationException;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        try {
            User::factory()->createOne([
                'name' => fake()->name(),
                'email' => fake()->unique()->email(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
        } catch (UniqueConstraintViolationException) {

        }
    }

}
