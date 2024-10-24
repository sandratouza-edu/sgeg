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
        Schema::create('garments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->boolean('available')->default(true);
            $table->unsignedSmallInteger('height')->nullable();
            $table->unsignedSmallInteger('width')->nullable();
            $table->unsignedSmallInteger('waist')->nullable();         
            $table->string('color')->nullable();
            $table->boolean('with_cap')->default(false)->nullable();
            $table->unsignedSmallInteger('size_cap')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id');
            
            $table->timestamps();
         //
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garments');
    }
};
