<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('smart_energy', function (Blueprint $table) {
            $table->id('id_smart_energy');
            $table->unsignedBigInteger('id_device');
            $table->string('data1')->nullable();
            $table->string('data2')->nullable();
            $table->string('data3')->nullable();
            $table->timestamps();
    
            $table->foreign('id_device')->references('id_device')->on('device')->onDelete('cascade');
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smart_energy');
    }
};
