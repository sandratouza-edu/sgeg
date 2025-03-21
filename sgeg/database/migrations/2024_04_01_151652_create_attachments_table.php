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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('uri');
            $table->string('name')->nullable();
            $table->enum('type', ['image', 'doc'])->default('doc');
            $table->text('description')->nullable();
            $table->string('keywords')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            // Definir la clave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
