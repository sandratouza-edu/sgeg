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
        Schema::create('attaches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('uri');
            $table->string('name')->nullable();;
            $table->string('type')->default('doc');;
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->unsignedBigInteger('user_id');

            // Definir la clave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attaches');
    }
};
