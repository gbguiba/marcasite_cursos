<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;

class EnrollmentSeeder extends Seeder {
    
    public function run(): void {

        DB::transaction(function() {

            $courses = Course::all();

            foreach (User::all() as $user) {

                $course = $courses->random();

                Enrollment::factory()->count(1)->create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ]);

            }

        });

    }

}
