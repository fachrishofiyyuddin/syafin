<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuans';  // optional kalau nama tabel sesuai konvensi

    protected $fillable = [
        'nasabah_id',
        'jenis_pengajuan',
        'jumlah_dana',
        'status',
        'keterangan',
        'bukti_ktp',
    ];

    // Relasi ke Nasabah
    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
