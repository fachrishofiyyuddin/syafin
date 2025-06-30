<?php

use App\Http\Controllers\Api\TelegramController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\MidtransSettingController;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Route;


Route::post('/webhook/telegram', [TelegramController::class, 'webhook']);
Route::post('/midtrans/callback', [MidtransController::class, 'callback']);
Route::post('/admin/midtrans/test', [MidtransSettingController::class, 'testConnection'])->name('admin.midtrans.test');
Route::get('/tracking/{id}', function ($id) {
    $pengajuan = Pengajuan::find($id);

    if (!$pengajuan) {
        return response()->json([
            'success' => false,
            'message' => 'Nomor pengajuan tidak ditemukan.'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'pengajuan' => [
            'nomor' => $pengajuan->id,
            'tanggal' => $pengajuan->created_at->format('d M Y'),
            'status' => ucfirst($pengajuan->status),
            'status_verifikasi' => $pengajuan->status_verifikasi,
        ]
    ]);
});
