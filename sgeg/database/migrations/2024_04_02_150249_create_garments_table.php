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
            $table->unsignedSmallInteger('height');
            $table->unsignedSmallInteger('width');
            $table->unsignedSmallInteger('waist');            
            $table->string('color');
            $table->boolean('with_cap')->default(false);
            $table->unsignedSmallInteger('size_cap');
            $table->unsignedBigInteger('pdi_id');
            
            $table->timestamps();
         //
            $table->foreign('pdi_id')->references('id')->on('p_d_i_s')->onUpdate('cascade')->onDelete('cascade');
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
