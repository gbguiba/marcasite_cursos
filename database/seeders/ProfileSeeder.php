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

                $newName = fake()->name();

                Profile::factory()->count(1)->create([
                    'user_id' => $user->id,
                    'name' => $newName,
                ]);

                $user->email = Str::slug($newName, '.') . '@example.com';
                $user->save();
                
            }
        
        });
    
    }

}
