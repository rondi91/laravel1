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
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesan_id')->constrained()->onDelete('cascade');
            // $table->foreignId('pelanggan_id')->constrained()->onDelete('cascade');
            $table->foreignId('produk_id')->constrained()->onDelete('cascade');
            $table->foreignId('warna_id')->constrained()->onDelete('cascade');
            $table->foreignId('size_id')->constrained()->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('unit_price', 8, 2);
            
            // $table->unsignedBigInteger('pesan_id');
            // $table->unsignedBigInteger('produk_id');
            // $table->unsignedBigInteger('warna_id');
            // $table->unsignedBigInteger('size_id');
            
            $table->timestamps();
            
            
            
            // $table->foreign('pesan_id')->references('id')->on('pesans')->onDelete('cascade');
            // $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
            // $table->foreign('warna_id')->references('id')->on('warnas')->onDelete('cascade');
            // $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');

        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};
