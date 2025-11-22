<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::table('profiles', function (Blueprint $table) {

            $table->string('cpf');

        });

    }

    public function down(): void {

        Schema::table('profiles', function (Blueprint $table) {

            $table->dropColumn('cpf');

        });

    }

};
