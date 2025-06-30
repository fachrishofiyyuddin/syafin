<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifikasiPengajuanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nomorPengajuan;

    public function __construct($nomorPengajuan)
    {
        $this->nomorPengajuan = $nomorPengajuan;
    }

    public function build()
    {
        return $this->subject('✅ Pengajuan Dana Diterima')
            ->view('emails.notifikasi_pengajuan');
    }
}
