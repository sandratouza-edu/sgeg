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
        Schema::create('pdis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('degree')->nullable(); 
            $table->date('thesis_date')->nullable();
            //$table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('is_goodfather')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          
            $table->foreign('is_godfather')->references('id')->on('degrees')->onDelete('set null');
            $table->foreign('degree')->references('id')->on('degrees')->onDelete('set null');
        });
    }

 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdis');
    }
};
