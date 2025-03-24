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
        Schema::create('t_penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('no_penjualan')->unique();
            $table->date('tanggal');
            $table->unsignedBigInteger('m_user_id')->nullable();
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('m_user_id')->references('id')->on('m_user')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan');
    }
};
