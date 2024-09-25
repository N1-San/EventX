<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendor_list', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('event_id');
            $table->string('vendor_name', 255);
            $table->string('service_type', 255);
            $table->string('contact_name', 255);
            $table->string('email', 255);
            $table->string('phone_number', 20);
            $table->enum('contract_status', ['pending', 'signed', 'completed']);
            $table->softDeletesTz();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_list');
    }
};
