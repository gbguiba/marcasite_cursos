<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Enrollment;
use Illuminate\Support\Str;

class EnrollmentFactory extends Factory {
    
    public function definition(): array {

        return [
            'id' => (string) Str::uuid(),
            'ip' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'user_id' => null,
            'course_id' => null,
        ];
    
    }

}
