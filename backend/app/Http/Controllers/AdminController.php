<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::with('user')->get();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
        ]);

        Admin::create($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $admin = Admin::with('user')->findOrFail($id);
        return view('admin.show', compact('admin'));
    }

    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, string $id)
    {
        $admin = Admin::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
        ]);

        $admin->update($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus');
    }
}
