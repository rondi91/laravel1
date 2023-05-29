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
        Schema::create('langganans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pelanggan_id')->unsigned();
            $table->integer('paket_id')->unsigned();
            $table->date('Tanggal_Mulai');
            $table->date('Tanggal_Berakhir');
            $table->string('Status_Langganan');
            $table->timestamps();
            
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans');
            $table->foreign('paket_id')->references('id')->on('pakets');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('langganans');
    }
};
