<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseMaterialFactory extends Factory {
    
    public function definition(): array {

        return [
            'id' => (string) Str::uuid(),
            'ip' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'course_id' => null,
            'name' => fake()->sentence(3),
            'description' => fake()->paragraphs(2, true),
            'path' => null,
        ];

    }
}
