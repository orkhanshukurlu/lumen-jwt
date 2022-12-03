<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name'     => $this->faker->name,
            'email'    => $this->faker->unique()->safeEmail,
            'password' => app('hash')->make('12345')
        ];
    }
}
