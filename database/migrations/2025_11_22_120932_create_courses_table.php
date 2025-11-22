<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::create('courses', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->timestamps();

            $table->string('ip');
            $table->text('user_agent');

            $table->string('name');
            $table->uuid('course_category_id');
            $table->double('price');
            $table->integer('places')->default(0);
            $table->datetime('registration_start')->nullable();
            $table->datetime('registration_end')->nullable();
            $table->longText('description');
            $table->string('thumbnail_path')->nullable();
            $table->boolean('active')->default(false);

        });

        Schema::table('courses', function (Blueprint $table) {

            $table->foreign('course_category_id')->references('id')->on('course_categories');

        });

    }

    public function down(): void {

        Schema::dropIfExists('courses');

    }

};
