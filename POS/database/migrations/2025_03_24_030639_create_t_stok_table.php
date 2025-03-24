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
        Schema::create('t_stok', function (Blueprint $table) {
            $table->id('stok_id');
            $table->integer('stok_jumlah');
            $table->dateTime('stok_tanggal');
            $table->unsignedBigInteger('barang_id')->index(); // already exists
            $table->unsignedBigInteger('supplier_id')->index();  // new column to reference supplier
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamps();
    
            $table->foreign('barang_id')->references('barang_id')->on('m_barang');
            $table->foreign('supplier_id')->references('supplier_id')->on('m_supplier');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_stok');
    }
};
