@extends('admin.layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 mt-10 rounded-2xl shadow-xl border border-gray-100">
        <div class="flex items-center gap-3 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9 12h3v9h-3zM13.5 3h3v18h-3z" />
            </svg>
            <h2 class="text-2xl font-bold text-gray-800">Pengaturan Telegram Bot</h2>
        </div>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded mb-5">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi Webhook Description --}}
        @if (session('webhook_response'))
            <div class="bg-blue-50 border border-blue-300 text-blue-800 px-4 py-3 rounded mb-5">
                🔔 Telegram: {{ session('webhook_response') }}
            </div>
        @endif

        {{-- Notifikasi Tes Webhook --}}
        @if (session('test_result'))
            <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 px-4 py-3 rounded mb-5">
                📡 Tes Koneksi: {{ session('test_result.description') ?? 'Tidak ada respons.' }}
            </div>
        @endif

        <form method="POST" action="{{ secure_url(route('admin.telegram.update', [], false)) }}" class="space-y-6">
            @csrf

            <!-- Bot Token -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">🔑 Bot Token</label>
                <input type="text" name="bot_token" value="{{ old('bot_token', $setting->bot_token ?? '') }}"
                    placeholder="Masukkan token bot Telegram..."
                    class="w-full border rounded-lg px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bot_token') border-red-500 @enderror"
                    required>
                @error('bot_token')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bot Name -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">🤖 Nama Bot</label>
                <input type="text" name="bot_name" value="{{ old('bot_name', $setting->bot_name ?? '') }}"
                    placeholder="Contoh: SyafinBot"
                    class="w-full border rounded-lg px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bot_name') border-red-500 @enderror">
                @error('bot_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Webhook URL -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">🌐 Webhook URL</label>
                <input type="url" name="webhook_url" value="{{ old('webhook_url', $setting->webhook_url ?? '') }}"
                    placeholder="https://domainmu.com/webhook"
                    class="w-full border rounded-lg px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('webhook_url') border-red-500 @enderror">
                @error('webhook_url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tampilkan JSON Response --}}
            @if (session('webhook_json'))
                <div>
                    <label class="block mb-1 text-sm font-semibold text-gray-700">📦 Respons JSON Telegram</label>
                    <textarea readonly rows="6"
                        class="w-full border rounded-lg px-4 py-3 bg-gray-100 text-gray-700 font-mono text-sm cursor-not-allowed">{{ json_encode(session('webhook_json'), JSON_PRETTY_PRINT) }}</textarea>
                </div>
            @endif

            {{-- Tombol --}}
            <div class="flex justify-between pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg shadow-md transition">
                    Simpan
                </button>

                <button type="submit" name="test_connection" value="1"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md shadow transition-all">
                    🔍 Tes Koneksi
                </button>
            </div>
        </form>
    </div>
@endsection
