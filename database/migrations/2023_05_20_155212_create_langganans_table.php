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
            $table->increments('langganan_id');
            $table->integer('pelanggan_id')->unsigned();
            $table->integer('paket_id')->unsigned();
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->foreign('pelanggan_id')->references('pelanggan_id')->on('pelanggans');
            $table->foreign('paket_id')->references('paket_id')->on('pakets');
       
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
