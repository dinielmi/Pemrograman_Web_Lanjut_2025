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
        Schema::create('m_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('stok')->default(0);
            $table->decimal('harga', 10, 2);
            $table->unsignedBigInteger('m_kategori_id');
            $table->unsignedBigInteger('m_supplier_id');
            $table->timestamps();

            $table->foreign('m_kategori_id')->references('id')->on('m_kategori')->onDelete('cascade');
            $table->foreign('m_supplier_id')->references('id')->on('m_supplier')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_barang');
    }
};
