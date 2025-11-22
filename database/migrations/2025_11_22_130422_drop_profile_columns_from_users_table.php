<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('name');
            $table->dropColumn('photo_path');

        });

    }

    public function down(): void {

        Schema::table('users', function (Blueprint $table) {

            $table->string('name');
            $table->string('photo_path')->nullable();

        });

    }

};
