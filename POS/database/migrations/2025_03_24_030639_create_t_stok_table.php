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
            $table->id();
            $table->unsignedBigInteger('m_barang_id');
            $table->integer('qty_in')->default(0);
            $table->integer('qty_out')->default(0);
            $table->date('tanggal')->nullable();
            $table->timestamps();

            $table->foreign('m_barang_id')->references('id')->on('m_barang')->onDelete('cascade');
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
