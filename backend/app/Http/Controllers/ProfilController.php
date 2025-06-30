<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    // Menampilkan halaman profil
    public function index()
    {
        // Mengambil data user yang sedang login
        $user = Auth::user(); // Mengambil data user yang sedang login

        // Jika tidak ada user yang login, arahkan ke halaman login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        return view('admin.profil.index', compact('user')); // Mengirim data user ke view profil
    }
}
