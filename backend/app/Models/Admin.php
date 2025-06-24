<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins'; // opsional kalau nama tabel 'admin'

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'jabatan', // misal ada kolom jabatan
    ];

    // Relasi ke User (akun login)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
