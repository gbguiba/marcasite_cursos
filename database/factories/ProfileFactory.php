<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class ProfileFactory extends Factory {

    public function definition(): array {

        return [
            'id' => (string) Str::uuid(),
            'ip' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'photo_path' => null,
            'cpf' => fake()->cpf(false),
        ];

    }

}
