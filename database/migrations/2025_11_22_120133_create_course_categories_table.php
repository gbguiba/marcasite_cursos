<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::create('course_categories', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->timestamps();

            $table->string('ip');
            $table->text('user_agent');
            
            $table->string('name');

        });

    }

    public function down(): void {

        Schema::dropIfExists('course_categories');

    }

};
