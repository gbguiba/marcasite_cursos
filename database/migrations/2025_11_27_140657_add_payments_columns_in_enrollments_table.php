<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    
    public function up(): void {
        
        Schema::table('enrollments', function (Blueprint $table) {
            
            $table->enum('method', ['pix']);
            
            $table->string('currency');
            $table->double('transaction_amount');
            
            $table->uuid('idempotency_key');
            
            $table->string('transaction_id')->nullable();

            $table->string('status')->nullable();
            $table->string('status_detail')->nullable();
            
            $table->string('pix_email')->nullable();
            $table->string('pix_qr_code')->nullable();
            $table->longText('pix_qr_code_base64')->nullable();
            $table->datetime('pix_expiration')->nullable();
        
        });
    
    }

    public function down(): void {

        Schema::table('enrollments', function (Blueprint $table) {
            
            $table->dropColumn('method');
            
            $table->dropColumn('currency');
            $table->dropColumn('transaction_amount');
            
            $table->dropColumn('idempotency_key');
            
            $table->dropColumn('transaction_id');
            
            $table->dropColumn('status');
            $table->dropColumn('status_detail');
            
            $table->dropColumn('pix_email');
            $table->dropColumn('pix_qr_code');
            $table->dropColumn('pix_qr_code_base64');
            $table->dropColumn('pix_expiration');
        
        });

    }

};
