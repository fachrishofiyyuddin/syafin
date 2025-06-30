@extends('admin.layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 mt-10 rounded-2xl shadow-xl border border-gray-100" x-data="midtransTest()">
        <div class="flex items-center gap-3 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M12 1a11 11 0 100 22 11 11 0 000-22zM7 10h2v7H7v-7zm8 0h2v7h-2v-7zm-4 0h2v7h-2v-7zm1-3a1.5 1.5 0 11-.001 3.001A1.5 1.5 0 0112 7z" />
            </svg>
            <h2 class="text-2xl font-bold text-gray-800">Pengaturan Midtrans</h2>
        </div>

        <form method="POST" action="{{ secure_url(route('admin.midtrans.update', [], false)) }}" class="space-y-6">
            @csrf

            {{-- Server Key --}}
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">🔐 Server Key</label>
                <input type="text" name="server_key" x-model="server_key"
                    value="{{ old('server_key', $setting->server_key ?? '') }}"
                    class="w-full border rounded-lg px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>

            {{-- Client Key --}}
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">🔑 Client Key</label>
                <input type="text" name="client_key" x-model="client_key"
                    value="{{ old('client_key', $setting->client_key ?? '') }}"
                    class="w-full border rounded-lg px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>

            {{-- Mode --}}
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-700">⚙️ Mode</label>
                <select name="is_production" x-model="is_production"
                    class="w-full border rounded-lg px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
                    <option value="0">Sandbox (Development)</option>
                    <option value="1">Production</option>
                </select>
            </div>

            <div class="flex justify-between items-center mt-4">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2 rounded-lg shadow-sm">
                    Simpan
                </button>

                <button type="button" @click="testConnection()"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-sm">
                    🔍 Tes Koneksi
                </button>
            </div>
        </form>

        {{-- Hasil Tes Koneksi --}}
        <template x-if="testResult">
            <div class="mt-6 bg-gray-50 border px-4 py-3 rounded text-sm">
                <div x-text="testResult.status === 'success' ? '✅ success' : '❌ ' + testResult.message"
                    :class="testResult.status === 'success' ? 'text-green-700' : 'text-red-700'"></div>
                <template x-if="testResult && testResult.token">
                    <div class="mt-2 text-xs text-gray-600">
                        Snap Token: <span class="font-mono text-blue-600" x-text="testResult.token"></span>
                        <br>
                        <a class="text-blue-500 underline" :href="testResult.redirect_url" target="_blank">🔗 Lihat Snap
                            Redirect</a>
                    </div>
                </template>
            </div>
        </template>
    </div>

    <script>
        function midtransTest() {
            return {
                server_key: '{{ old('server_key', $setting->server_key ?? '') }}',
                client_key: '{{ old('client_key', $setting->client_key ?? '') }}',
                is_production: '{{ old('is_production', $setting->is_production ?? 0) }}',
                testResult: null,

                async testConnection() {
                    this.testResult = null;

                    try {
                        const response = await fetch(`{{ secure_url(route('admin.midtrans.test', [], false)) }}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                server_key: this.server_key,
                                client_key: this.client_key,
                                is_production: this.is_production
                            }),
                        });

                        const data = await response.json();

                        this.testResult = {
                            status: data.status,
                            message: data.message || '',
                            token: data.snap_token || null,
                            redirect_url: data.redirect_url || null,
                            midtrans_response: data.midtrans_response || null
                        };

                    } catch (error) {
                        this.testResult = {
                            status: 'error',
                            message: error.message || 'Terjadi kesalahan saat tes koneksi.'
                        };
                    }
                }
            }
        }
    </script>
@endsection
