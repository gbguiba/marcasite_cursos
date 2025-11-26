<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {
        
        Schema::table('courses', function (Blueprint $table) {

            $table->renameColumn('thumbnail_path', 'thumbnail');

        });
    
    }
    
    public function down(): void {
        
        Schema::table('courses', function (Blueprint $table) {

            $table->renameColumn('thumbnail', 'thumbnail_path');

        });
    
    }

};
