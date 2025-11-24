<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::create('users', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->timestamps();

            $table->string('ip');
            $table->text('user_agent');

            $table->string('name');
            $table->enum('type', ['user', 'admin'])->default('user');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('photo_path')->nullable();

        });

    }

    public function down(): void {

        Schema::dropIfExists('users');

    }

};
