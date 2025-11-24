<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder {

    public function run(): void {
        
        DB::transaction(function(): void {
            
            User::factory()->count(1)->create([
                'type' => 'admin',
            ]);

            User::factory()->count(15)->create([
                'type' => 'user',
            ]);
        
        });
    
    }

}
