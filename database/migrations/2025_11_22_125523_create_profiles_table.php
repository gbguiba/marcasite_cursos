<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::create('profiles', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->timestamps();

            $table->string('ip');
            $table->text('user_agent');

            $table->uuid('user_id');

            $table->string('name');
            $table->string('photo_path')->nullable();

        });

        Schema::table('profiles', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users');

        });

    }

    public function down(): void {

        Schema::dropIfExists('profiles');

    }

};
