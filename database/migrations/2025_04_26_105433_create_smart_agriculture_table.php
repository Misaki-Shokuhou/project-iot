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
        Schema::create('smart_agriculture', function (Blueprint $table) {
            $table->id('id_smart_agriculture');
            $table->unsignedBigInteger('id_device');
<<<<<<< HEAD
            $table->unsignedBigInteger('id_user'); // Tambahkan kolom id_user
            $table->string('data1')->nullable();
            $table->string('data2')->nullable();
            $table->timestamps();

            // Foreign key ke tabel device
            $table->foreign('id_device')->references('id_device')->on('device')->onDelete('cascade');

            // Foreign key ke tabel user
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
    }
=======
            $table->string('data1')->nullable();
            $table->string('data2')->nullable();
            $table->timestamps();
    
            $table->foreign('id_device')->references('id_device')->on('device')->onDelete('cascade');
        });
    }    
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smart_agriculture');
    }
};
