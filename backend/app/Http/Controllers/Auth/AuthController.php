<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function telegramLogin(Request $request)
    {
        $data = $request->all();
        $token = env('TELEGRAM_BOT_TOKEN');

        if (!$this->verifyTelegramHash($data, $token)) {
            abort(403, 'Data tidak valid');
        }

        $username = $data['username'] ?? ('user' . $data['id']);
        // $email = $username . '@telegram.local';

        // Cek jika user sudah ada berdasarkan telegram_id atau email
        $user = User::where('telegram_id', $data['id'])->orWhere('email', $email)->first();

        if (!$user) {
            // Simpan ke users jika belum ada
            $user = User::create([
                'telegram_id' => $data['id'],
                'name' => $data['first_name'] ?? 'User Telegram',
                // 'email' => $email,
                'password' => bcrypt(Str::random(16)),
                'avatar' => $data['photo_url'] ?? null,
                'role' => 'nasabah',
            ]);
        } else {
            // Update data user jika sudah ada
            $user->update([
                'name' => $data['first_name'] ?? 'User Telegram',
                'avatar' => $data['photo_url'] ?? null,
            ]);
        }

        // Simpan ke nasabah jika belum ada
        Nasabah::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nama_lengkap' => $data['first_name'] ?? 'User Telegram',
                'nomor_telegram' => $data['id'],
            ]
        );

        // Login user
        Auth::login($user);

        // ✅ Redirect pakai JavaScript agar bisa keluar dari iframe Telegram login
        return response()->view('auth.telegram-redirect', [
            'redirectTo' => url('/dashboards'), // atau route('dashboard') kalau kamu punya named route
        ]);
    }




    private function verifyTelegramHash($data, $token)
    {
        $checkHash = $data['hash'];
        unset($data['hash']);

        $dataCheckArr = [];
        foreach ($data as $key => $value) {
            $dataCheckArr[] = "$key=$value";
        }
        sort($dataCheckArr);
        $dataCheckString = implode("\n", $dataCheckArr);

        $secretKey = hash('sha256', $token, true);
        $hash = hash_hmac('sha256', $dataCheckString, $secretKey);

        return hash_equals($hash, $checkHash);
    }
}
