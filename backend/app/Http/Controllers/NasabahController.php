<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    public function index()
    {
        // Tampilkan semua data nasabah beserta relasi user-nya
        $nasabahs = Nasabah::with('user')->get();
        return view('nasabah.index', compact('nasabahs'));
    }

    public function create()
    {
        // Tampilkan form tambah nasabah baru
        return view('nasabah.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telegram' => 'nullable|string|max:100',
        ]);

        Nasabah::create($validated);

        return redirect()->route('nasabah.index')->with('success', 'Data nasabah berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $nasabah = Nasabah::with('user')->findOrFail($id);
        return view('nasabah.show', compact('nasabah'));
    }

    public function edit(string $id)
    {
        $nasabah = Nasabah::findOrFail($id);
        return view('nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, string $id)
    {
        $nasabah = Nasabah::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telegram' => 'nullable|string|max:100',
        ]);

        $nasabah->update($validated);

        return redirect()->route('nasabah.index')->with('success', 'Data nasabah berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $nasabah = Nasabah::findOrFail($id);
        $nasabah->delete();

        return redirect()->route('nasabah.index')->with('success', 'Data nasabah berhasil dihapus');
    }
}
