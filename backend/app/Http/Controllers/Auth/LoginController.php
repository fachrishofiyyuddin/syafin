<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('auth.index'); // Ganti dengan view login sesuai dengan tampilan yang dimaksud
    }

    /**
     * Proses login pengguna (admin/nasabah).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mengambil data username dan password dari form
        $username = $validated['username'];
        $password = $validated['password'];

        // Cek kredensial login
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            // Jika login berhasil, cek peran (role) user
            $user = Auth::user();

            // Redirect berdasarkan role user
            if ($user->role === 'admin') {
                // Admin login, arahkan ke dashboard admin
                return redirect()->route('dashboards');
            } elseif ($user->role === 'nasabah') {
                // Nasabah login, arahkan ke dashboard nasabah
                return redirect()->route('dashboards');
            }
        }

        // Jika login gagal, kembali dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau Password salah.',
        ]);
    }

    /**
     * Logout pengguna.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Arahkan kembali ke halaman login
    }
}
