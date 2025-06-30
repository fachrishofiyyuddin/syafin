<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\TelegramSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramSettingController extends Controller
{
    public function index()
    {
        $setting = TelegramSetting::first();
        return view('admin.telegram.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'bot_token' => 'required|string',
            'bot_name' => 'nullable|string',
            'webhook_url' => 'nullable|url',
        ]);

        // Cek jika user menekan tombol tes saja
        if ($request->has('test_connection')) {
            // Coba panggil API Telegram
            $response = Http::get("https://api.telegram.org/bot{$request->bot_token}/setWebhook", [
                'url' => $request->webhook_url,
            ]);

            return redirect()->back()
                ->with('test_result', $response->json());
        }

        // Simpan data ke database
        $setting = TelegramSetting::firstOrNew(['id' => 1]);
        $setting->bot_token = $request->bot_token;
        $setting->bot_name = $request->bot_name; // ← Tambahkan ini
        $setting->webhook_url = $request->webhook_url;
        $setting->save();

        // Set webhook ke Telegram
        $response = Http::get("https://api.telegram.org/bot{$setting->bot_token}/setWebhook", [
            'url' => $setting->webhook_url,
        ]);

        $responseData = $response->json();

        return redirect()->back()
            ->with('success', 'Pengaturan Telegram berhasil disimpan!')
            ->with('webhook_response', $responseData['description'] ?? 'Tidak ada deskripsi.')
            ->with('webhook_json', $responseData);
    }
}
