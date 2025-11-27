<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\CourseCategorySeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\CourseMaterialSeeder;

class DatabaseSeeder extends Seeder {
    
    use WithoutModelEvents;
    
    public function run(): void {
        
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            CourseCategorySeeder::class,
            CourseSeeder::class,
            CourseMaterialSeeder::class,
        ]);
    
    }

}
