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
            $table->string('jenis_pengajuan'); // misal: konsumtif, produktif, darurat
            $table->bigInteger('jumlah_dana'); // jumlah dana dalam rupiah
            $table->string('status')->default('pending'); // status pengajuan (pending, approved, rejected)
            $table->text('keterangan')->nullable(); // catatan tambahan, opsional
            $table->string('bukti_ktp')->nullable(); // path file KTP yang diupload (jika ada)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuans');
    }
}
