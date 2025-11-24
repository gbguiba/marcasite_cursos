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

            $admin = new User();
            $admin->id = (string) Str::uuid();
            $admin->ip = fake()->ipv4();
            $admin->user_agent = fake()->userAgent();
            $admin->type = 'admin';
            $admin->email = fake()->unique()->safeEmail();
            $admin->password = Hash::make('123456');
            $admin->email_verified_at = Carbon::now();
            $admin->active = true;
            $admin->save();
            
            User::factory()->count(15)->create();
        
        });
    
    }

}
