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
        Schema::create('t_penjualan_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('t_penjualan_id');
            $table->unsignedBigInteger('m_barang_id');
            $table->integer('qty')->default(1);
            $table->decimal('harga', 10, 2);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();

            $table->foreign('t_penjualan_id')->references('id')->on('t_penjualan')->onDelete('cascade');
            $table->foreign('m_barang_id')->references('id')->on('m_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan_detail');
    }
};
