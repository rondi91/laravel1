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
            $table->unsignedInteger('langganan_id');
            $table->decimal('jumlah_pembayaran', 8, 2);
            $table->date('tanggal_pembayaran');
            $table->timestamps();
    
            $table->foreign('langganan_id')->references('id')->on('langganans')->onDelete('cascade');
        
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
