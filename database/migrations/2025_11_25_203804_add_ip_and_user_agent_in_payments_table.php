<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {

        Schema::table('payments', function (Blueprint $table) {

            $table->string('ip');
            $table->text('user_agent');

        });
    
    }
    
    public function down(): void {

        Schema::table('payments', function (Blueprint $table) {

            $table->dropColumn('ip');
            $table->dropColumn('user_agent');
        
        });
    
    }

};
