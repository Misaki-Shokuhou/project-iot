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
        Schema::create('unregistered', function (Blueprint $table) {
            $table->id('id_unregistered');  // Menggunakan id_unregistered sebagai primary key
            $table->string('device_uid')->unique();  // Kolom untuk menyimpan device_uid
            $table->string('tipe_device');           // Kolom untuk menyimpan tipe perangkat
            $table->timestamps();                  // Kolom untuk timestamps (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unregistered');
    }
};
