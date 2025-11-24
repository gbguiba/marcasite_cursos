<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileSeeder extends Seeder {

    public function run(): void {

        $users = User::all();

        DB::transaction(function() use($users): void {

            foreach ($users as $user) {

                $profile = new Profile();
                $profile->id = (string) Str::uuid();
                $profile->ip = fake()->ipv4();
                $profile->user_agent = fake()->userAgent();
                $profile->user_id = $user->id;
                $profile->name = fake()->name();
                $profile->photo_path = null;
                $profile->cpf = fake()->numerify('###########');
                $profile->save();

            }
        
        });
    
    }

}
