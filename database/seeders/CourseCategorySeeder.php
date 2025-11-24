<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CourseCategory;

class CourseCategorySeeder extends Seeder {
    
    public function run(): void {

        DB::transaction(function() {

            CourseCategory::factory()->count(8)->create();

        });

    }
}
