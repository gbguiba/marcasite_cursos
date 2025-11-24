<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {
        
        Schema::create('enrollments', function (Blueprint $table) {
        
            $table->uuid('id')->primary();

            $table->timestamps();
        
            $table->string('ip');
            $table->text('user_agent');

            $table->uuid('user_id');
            $table->uuid('course_id');

        });

        Schema::table('enrollments', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users');

        });

        Schema::table('enrollments', function (Blueprint $table) {

            $table->foreign('course_id')->references('id')->on('courses');

        });
    
    }
    
    public function down(): void {
        
        Schema::dropIfExists('enrollments');
    
    }

};
