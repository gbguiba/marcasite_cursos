<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserFactory extends Factory {

    public function definition(): array {

        return [
            'id' => (string) Str::uuid(),
            'ip' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'type' => 'user',
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('123456'),
            'email_verified_at' => Carbon::now(),
            'active' => true,
        ];

    }

}
