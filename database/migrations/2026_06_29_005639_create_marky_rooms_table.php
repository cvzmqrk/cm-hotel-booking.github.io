<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('marky_rooms', function (Blueprint $table) {
            $table->id('marky_room_id');
            $table->string('marky_room_name');
            $table->text('marky_room_description');
            $table->decimal('marky_room_price', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marky_rooms');
    }
};