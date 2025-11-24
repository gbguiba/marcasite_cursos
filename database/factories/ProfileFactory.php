<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class ProfileFactory extends Factory {

    public function definition(): array {

        return [
            'id' => (string) Str::uuid(),
            'ip' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'user_id' => null,
            'name' => fake()->name(),
            'photo_path' => null,
            'cpf' => fake()->cpf(false),
        ];

    }

}
