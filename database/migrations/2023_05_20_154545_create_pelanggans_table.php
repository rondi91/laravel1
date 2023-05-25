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
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->increments('pelanggan_id');
            $table->string('nama_pelanggan');
            $table->string('alamat');
            $table->string('nomor_telepon');
            $table->integer('langganan_id')->unsigned();
            // php artisan make:migration add_field_to_pelanggans --table=pelanggans
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
