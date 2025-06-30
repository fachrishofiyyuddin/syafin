<?php

namespace App\Http\Controllers;

use App\Models\GoogleAuthSetting;
use Illuminate\Http\Request;

class GoogleAuthSettingController extends Controller
{
    /**
     * Tampilkan form pengaturan Google Auth
     */
    public function index()
    {
        $setting = GoogleAuthSetting::first();
        return view('admin.google_auth.index', compact('setting'));
    }

    /**
     * Simpan atau update pengaturan Google Auth
     */
    public function update(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'client_secret' => 'required',
            'redirect_uri' => 'required|url',
        ]);

        GoogleAuthSetting::updateOrCreate(
            ['id' => 1],
            $request->only('client_id', 'client_secret', 'redirect_uri')
        );

        return redirect()->back()->with('success', 'Google Auth berhasil diperbarui.');
    }

    /**
     * Tes koneksi Google OAuth: Redirect ke halaman login Google
     */
    public function test()
    {
        $setting = GoogleAuthSetting::first();

        if (!$setting || !$setting->client_id || !$setting->redirect_uri) {
            return redirect()->back()->with('error', 'Pengaturan Google Auth belum lengkap.');
        }

        // Query untuk Google OAuth login
        $query = http_build_query([
            'client_id' => $setting->client_id,
            'redirect_uri' => $setting->redirect_uri,
            'response_type' => 'code',
            'scope' => 'email profile',
            'access_type' => 'offline',
            'prompt' => 'consent',
        ]);

        // Redirect ke halaman login Google
        return redirect('https://accounts.google.com/o/oauth2/auth?' . $query);
    }
}
