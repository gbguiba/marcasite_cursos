<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::create('course_materials', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->timestamps();

            $table->string('ip');
            $table->text('user_agent');

            $table->uuid('course_id');

            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('path')->nullable();

        });

        Schema::table('course_materials', function (Blueprint $table) {

            $table->foreign('course_id')->references('id')->on('courses');

        });

    }

    public function down(): void {

        Schema::dropIfExists('course_materials');

    }

};
