<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\WhatsappLoginController;
use App\Http\Controllers\BotCommandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Models\Nasabah;
use App\Models\User;

// ✅ Halaman publik
Route::get('/', function () {
    return view('landing.index');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');

// Proses login
Route::post('login', [LoginController::class, 'postLogin'])->name('post.login');

Route::get('/auth/telegram', [AuthController::class, 'telegramLogin'])->name('telegram.auth');

// ✅ Autentikasi Google
Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')
        ->with(['prompt' => 'consent', 'access_type' => 'offline'])
        ->redirect();
})->name('google.login');

Route::get('/auth/callback/google', function () {
    $googleUser = Socialite::driver('google')->user();

    // Simpan atau update user
    $user = User::updateOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'avatar' => $googleUser->getAvatar(),
            'password' => bcrypt(Str::random(16)),
        ]
    );

    // Simpan atau update nasabah
    Nasabah::updateOrCreate(
        ['user_id' => $user->id],
        ['nama_lengkap' => $googleUser->getName()]
    );

    Auth::login($user);
    return redirect('/dashboards');
});

// ✅ Logout
Route::post('/logout', function (Request $request) {
    $user = $request->user();

    // Hapus telegram_id user (opsional, jika memang ingin unlink Telegram)
    $user->telegram_id = null;
    $user->save();

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');


// ✅ Route yang wajib login
Route::middleware('auth')->group(function () {
    Route::get('/dashboards', [DashboardController::class, 'index'])->name('dashboards');
    Route::post('/submit', [PengajuanController::class, 'store'])->name('submit.store');
    Route::put('/pengajuan/{id}/verifikasi', [PengajuanController::class, 'verifikasi'])->name('pengajuan.verifikasi');
    Route::put('/pengajuan/{id}/ubah-status', [PengajuanController::class, 'ubahStatus'])->name('pengajuan.ubahStatus');
    Route::get('/pengajuan/{id}/tagihan', [PengajuanController::class, 'showTagihan'])->name('tagihan.show');
    Route::post('/bayar', [PengajuanController::class, 'bayar'])->name('bayar.sekarang');
    Route::post('/pembayaran/update-status', [PengajuanController::class, 'updateStatusManual'])->name('pembayaran.updateStatus');

    // Route untuk halaman pengaturan Bot Commands
    Route::get('admin/bot/commands', [BotCommandController::class, 'index'])->name('bot.commands.index');
    Route::get('admin/bot/commands/create', [BotCommandController::class, 'create'])->name('bot.commands.create');
    Route::post('admin/bot/commands', [BotCommandController::class, 'store'])->name('bot.commands.store');
    Route::get('admin/bot/commands/{id}/edit', [BotCommandController::class, 'edit'])->name('bot.commands.edit');
    Route::put('admin/bot/commands/{id}', [BotCommandController::class, 'update'])->name('bot.commands.update');
    Route::delete('admin/bot/commands/{id}', [BotCommandController::class, 'destroy'])->name('bot.commands.destroy');
});
