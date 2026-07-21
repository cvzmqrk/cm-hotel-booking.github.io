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
        Schema::create('marky_bookings', function (Blueprint $table) {
            $table->id('marky_booking_id');
            // Establishes relational integrity constraint targeting the rooms index definition table
            $table->foreignId('marky_room_id')->constrained('marky_rooms', 'marky_room_id')->onDelete('cascade');
            $table->string('marky_customer_name');
            $table->string('marky_customer_email');
            
            // Core calendar allocation parameters
            $table->date('marky_check_in');
            $table->date('marky_check_out');
            $table->decimal('marky_total_price', 10, 2)->default(0.00);
            $table->string('marky_confirmation_file')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marky_bookings');
    }
};