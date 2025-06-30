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
        'no_rek',
        'bank',
        'jenis_pengajuan',
        'jumlah_dana',
        'jatuh_tempo',
        'deskripsi_pengajuan',
        'status',
        'status_verifikasi',
        'bukti_ktp',
        'swafoto_ktp',
    ];

    // Relasi ke Nasabah
    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
