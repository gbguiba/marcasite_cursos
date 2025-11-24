<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder {
    
    public function run(): void {

        DB::transaction(function() {
            
            Course::factory()->count(10)->create();

        });

    }

}
