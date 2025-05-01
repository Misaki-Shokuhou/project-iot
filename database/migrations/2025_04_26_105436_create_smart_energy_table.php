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
            $table->unsignedBigInteger('id_user'); // Tambahkan id_user
            $table->string('data1')->nullable();
            $table->string('data2')->nullable();
            $table->string('data3')->nullable();
            $table->timestamps();

            // Foreign key ke tabel device
            $table->foreign('id_device')->references('id_device')->on('device')->onDelete('cascade');

            // Foreign key ke tabel user (pastikan kolom `id_user` ada di tabel user)
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
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
