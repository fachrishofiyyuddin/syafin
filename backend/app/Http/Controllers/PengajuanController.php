<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    // Tampilkan semua pengajuan
    public function index()
    {
        $pengajuans = Pengajuan::with('nasabah')->get();
        return response()->json($pengajuans);
    }

    // Tampilkan form pengajuan (kalau pake blade view, kalau API biasanya nggak perlu)
    public function create()
    {
        //
    }

    // Simpan data pengajuan baru
    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:nasabah,id',
            'jenis_pengajuan' => 'required|string',
            'jumlah_dana' => 'required|numeric|min:100000',
            'keterangan' => 'nullable|string',
            'bukti_ktp' => 'nullable|string', // bisa juga validasi file kalau upload
        ]);

        $pengajuan = Pengajuan::create($request->all());

        return response()->json([
            'message' => 'Pengajuan berhasil dibuat',
            'data' => $pengajuan
        ], 201);
    }

    // Tampilkan detail pengajuan
    public function show($id)
    {
        $pengajuan = Pengajuan::with('nasabah')->findOrFail($id);
        return response()->json($pengajuan);
    }

    // Update pengajuan
    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $request->validate([
            'jenis_pengajuan' => 'sometimes|string',
            'jumlah_dana' => 'sometimes|numeric|min:100000',
            'status' => 'sometimes|string',
            'keterangan' => 'nullable|string',
        ]);

        $pengajuan->update($request->all());

        return response()->json([
            'message' => 'Pengajuan berhasil diupdate',
            'data' => $pengajuan
        ]);
    }

    // Hapus pengajuan
    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();

        return response()->json([
            'message' => 'Pengajuan berhasil dihapus'
        ]);
    }
}
