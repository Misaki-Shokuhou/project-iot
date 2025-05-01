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
        Schema::create('device', function (Blueprint $table) {
            $table->id('id_device');
            $table->unsignedBigInteger('id_user')->nullable(); // id_user bisa null untuk device yang belum terdaftar
            $table->string('device_uid')->unique(); // Unique ID untuk masing-masing device
            $table->string('nama_device');
            $table->string('tipe_device'); // smart_home, smart_agriculture, smart_energy
            $table->timestamps();
    
            // Foreign key untuk user, jika ada (untuk device yang sudah terdaftar)
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device');
    }
};
