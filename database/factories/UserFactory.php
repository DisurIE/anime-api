<?php
namespace Database\Factories;

use Illuminate\Support\Str;
use App\Framework\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Framework\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->email(),
            'email_verified_at' => now(),
            'password' => Str::random(234),  // Use bcrypt instead of Hash::make
            'remember_token' => Str::random(10),
        ];
    }
}

