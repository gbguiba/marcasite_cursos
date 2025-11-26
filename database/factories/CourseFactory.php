<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CourseCategory;
use Carbon\Carbon;

class CourseFactory extends Factory {
    
    public function definition(): array {
        
        return [
            'id' => (string) Str::uuid(),
            'ip' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'name' => fake()->sentence(3),
            'course_category_id' => null,
            'price' => fake()->randomFloat(2, 100, 1500),
            'places' => fake()->numberBetween(10, 500),
            'registration_start' => fake()->dateTimeBetween(Carbon::now(), Carbon::now()->addDays(10)),
            'registration_end' => fake()->dateTimeBetween(Carbon::now()->addDays(5), Carbon::now()->addDays(15)),
            'thumbnail' => null,
            'description' => fake()->paragraphs(2, true),
            'active' => fake()->boolean(),
        ];
    
    }

}
