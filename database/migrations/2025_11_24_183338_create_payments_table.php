<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void {

        Schema::create('payments', function (Blueprint $table) {
            
            $table->uuid('id')->primary();
            
            $table->timestamps();

            $table->uuid('enrollment_id');

            $table->enum('status', ['pago']);
        
        });

        Schema::table('payments', function (Blueprint $table) {

            $table->foreign('enrollment_id')->references('id')->on('enrollments');

        });
    
    }
    
    public function down(): void {
        
        Schema::dropIfExists('payments');
    
    }

};
