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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('langganan_id')->unsigned();
            $table->date('Tanggal_Pembayaran');
            $table->decimal('Jumlah_Pembayaran', 10, 2);
            $table->timestamps();
            
            $table->foreign('langganan_id')->references('id')->on('langganans');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
