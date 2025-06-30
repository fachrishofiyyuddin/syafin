<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuansTable extends Migration
{
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained('nasabahs')->onDelete('cascade'); // relasi ke nasabah
            $table->string('no_rek')->nullable(); // konsumtif, produktif, darurat
            $table->string('bank')->nullable(); // konsumtif, produktif, darurat
            $table->string('jenis_pengajuan'); // konsumtif, produktif, darurat
            $table->bigInteger('jumlah_dana'); // dana dalam rupiah
            $table->date('jatuh_tempo')->nullable();
            $table->string('status')->default('pending'); // pending, diproses, disetujui, ditolak, selesai
            $table->string('status_verifikasi')->default('belum diverifikasi'); // status verifikasi tambahan
            $table->text('catatan')->nullable(); // opsional catatan admin
            $table->text('deskripsi_penggunaan')->nullable(); // detail penggunaan dana
            $table->string('bukti_ktp')->nullable(); // file path
            $table->string('swafoto_ktp')->nullable(); // file path
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuans');
    }
}
