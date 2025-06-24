<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    // kalau tabelnya bernama 'nasabah', ini opsional
    protected $table = 'nasabahs';

    // kolom yang boleh diisi massal (mass assignment)
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nomor_telegram',
        // tambahkan kolom lain jika ada
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
