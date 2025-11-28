<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserFactory extends Factory {

    public function definition(): array {

        return [
            'id' => (string) Str::uuid(),
            'ip' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'type' => null,
            'email' => fake()->unique()->safeEmail(),
            'password' => '123456',
            'active' => fake()->boolean(),
        ];

    }

}
