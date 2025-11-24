<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Models\CourseCategory;

class CourseSeeder extends Seeder {
    
    public function run(): void {

        DB::transaction(function() {

            foreach (CourseCategory::all() as $courseCategory) {

                Course::factory()->count(rand(1, 3))->create([
                    'course_category_id' => $courseCategory->id,
                ]);
            
            }
        
        });
    
    }

}
