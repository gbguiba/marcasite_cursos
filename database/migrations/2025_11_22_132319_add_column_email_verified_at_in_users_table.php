<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::table('users', function (Blueprint $table) {

            $table->datetime('email_verified_at')->nullable();

        });

    }

    public function down(): void {

        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('email_verified_at');

        });

    }

};
