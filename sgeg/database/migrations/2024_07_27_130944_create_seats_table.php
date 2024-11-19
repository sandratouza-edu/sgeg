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
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('position');
            $table->boolean('usable')->default(true);
            $table->string('is_table')->default(false);
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['reserved', 'available','pending'])->default('available');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
