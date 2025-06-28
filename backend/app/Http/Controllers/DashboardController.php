<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Membuat query untuk pengajuan dengan relasi ke nasabah
        $query = Pengajuan::with('nasabah.user')->latest();

        // Mendapatkan pengguna yang sedang login
        $user = $request->user(); // Mengambil user yang sedang login

        // Jika user adalah nasabah, filter berdasarkan nasabah_id
        if ($user && $user->role === 'nasabah') {
            $query->whereHas('nasabah', function ($q) use ($user) {
                $q->where('user_id', $user->id); // Menggunakan user_id untuk filter
            });
        }

        // Menambahkan filter berdasarkan keyword (nama nasabah atau deskripsi pengajuan)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->whereHas('nasabah', function ($q2) use ($keyword) {
                    $q2->where('nama_lengkap', 'like', "%{$keyword}%"); // Mencari berdasarkan nama nasabah
                })
                    ->orWhere('deskripsi_penggunaan', 'like', "%{$keyword}%"); // Mencari berdasarkan deskripsi pengajuan
            });
        }

        // Filter berdasarkan jenis pengajuan
        if ($request->filled('jenis')) {
            $query->where('jenis_pengajuan', $request->jenis);
        }

        // Filter berdasarkan status pengajuan
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Mengambil data dengan pagination dan tetap bawa query string untuk paging
        $pengajuans = $query->paginate(5)->withQueryString();

        // Mengembalikan view dengan data pengajuan
        return view('admin.dashboard.index', compact('pengajuans'));
    }
}
