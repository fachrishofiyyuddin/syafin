<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained()->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->string('bulan')->nullable(); // Format: YYYY-MM (contoh: 2025-07)
            $table->integer('jumlah')->nullable();
            $table->integer('nominal')->nullable();
            $table->string('status')->default('pending'); // pending | success | failed
            $table->string('snap_token')->nullable();
            $table->timestamp('dibayar_pada')->nullable(); // Waktu pembayaran
            $table->timestamps();

            $table->unique(['pengajuan_id', 'bulan']); // Supaya 1 pengajuan tidak bisa bayar bulan yang sama 2x
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
};
