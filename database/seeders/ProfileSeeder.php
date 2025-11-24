<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileSeeder extends Seeder {

    public function run(): void {

        DB::transaction(function(): void {

            foreach (User::all() as $user) {

                Profile::factory()->count(1)->create([
                    'user_id' => $user->id,
                ]);
                
            }
        
        });
    
    }

}
