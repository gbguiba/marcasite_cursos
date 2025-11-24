<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\CourseMaterial;

class CourseMaterialSeeder extends Seeder {

    public function run(): void {

        DB::transaction(function() {

            foreach (Course::all() as $course) {

                CourseMaterial::factory()->count(rand(5, 15))->create([
                    'course_id' => $course->id,
                ]);

            }

        });

    }

}
