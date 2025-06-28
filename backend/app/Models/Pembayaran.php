<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['pengajuan_id', 'order_id', 'bulan', 'status', 'jumlah', 'nominal', 'dibayar_pada', 'snap_token'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
