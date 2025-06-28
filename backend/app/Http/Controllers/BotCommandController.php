<?php

namespace App\Http\Controllers;

use App\Models\BotCommand;
use Illuminate\Http\Request;

class BotCommandController extends Controller
{
    public function index(Request $request)
    {
        // Menggunakan paginate untuk membatasi jumlah data per halaman
        $botCommands = BotCommand::paginate(5); // Sesuaikan jumlah data per halaman jika diperlukan

        return view('admin.bot.index', compact('botCommands'));
    }

    public function create()
    {
        // Menampilkan form untuk membuat Bot Command baru
        return view('admin.bot.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $validated = $request->validate([
            'command' => 'required|string|unique:bot_commands,command', // Pastikan kolom command unik
            'label' => 'required|string',
            'response' => 'required|string',
        ]);

        // Menyimpan data ke dalam database
        BotCommand::create([
            'command' => $validated['command'],
            'label' => $validated['label'],
            'response' => $validated['response'],
            'is_active' => $request->has('is_active') ? 1 : 0, // Menyimpan status aktif
        ]);

        // Mengarahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('bot.commands.index')->with('success', 'Bot Command berhasil dibuat.');
    }

    public function edit($id)
    {
        // Mengambil data command yang akan diedit
        $command = BotCommand::findOrFail($id);

        return view('admin.bot.edit', compact('command'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'command' => 'required|string|unique:bot_commands,command,' . $id, // Pastikan command tetap unik, kecuali untuk yang sedang diedit
            'label' => 'required|string',
            'response' => 'required|string',
        ]);

        // Update data command
        $command = BotCommand::findOrFail($id);
        $command->update([
            'command' => $validated['command'],
            'label' => $validated['label'],
            'response' => $validated['response'],
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        // Mengarahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('bot.commands.index')->with('success', 'Bot Command berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Menghapus data command
        BotCommand::destroy($id);

        return redirect()->route('bot.commands.index')->with('success', 'Bot Command berhasil dihapus.');
    }
}
