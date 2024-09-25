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
        Schema::create('guest_list', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('event_id');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('phone_number', 20);
            // $table->enum('rsvp_status');
            $table->enum('rsvp_status', ['invited', 'attending', 'not_attending', 'maybe']);
            $table->boolean('plus_one');
            $table->softDeletesTz();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_list');
    }
};
