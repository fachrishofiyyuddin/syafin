@extends('admin.layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                🔐 Pengaturan Google Auth
            </h2>

            @if (session('success'))
                <div class="bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded mb-6">
                    ❌ {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ secure_url(route('admin.google-auth.update', [], false)) }}" class="space-y-6">
                @csrf

                <!-- Client ID -->
                <div>
                    <label for="client_id" class="text-sm font-medium text-gray-700">🔑 Client ID</label>
                    <input type="text" name="client_id" id="client_id"
                        value="{{ old('client_id', $setting->client_id ?? '') }}"
                        placeholder="Masukkan Client ID dari Google"
                        class="w-full border @error('client_id') border-red-500 @else border-gray-300 @enderror px-4 py-2 rounded-md bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                    @error('client_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Client Secret -->
                <div>
                    <label for="client_secret" class="text-sm font-medium text-gray-700">🔒 Client Secret</label>
                    <input type="text" name="client_secret" id="client_secret"
                        value="{{ old('client_secret', $setting->client_secret ?? '') }}"
                        placeholder="Masukkan Client Secret dari Google"
                        class="w-full border @error('client_secret') border-red-500 @else border-gray-300 @enderror px-4 py-2 rounded-md bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                    @error('client_secret')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Redirect URI -->
                <div>
                    <label for="redirect_uri" class="text-sm font-medium text-gray-700">🌐 Redirect URI</label>
                    <input type="url" name="redirect_uri" id="redirect_uri"
                        value="{{ old('redirect_uri', $setting->redirect_uri ?? '') }}"
                        placeholder="https://domain.com/auth/callback/google"
                        class="w-full border @error('redirect_uri') border-red-500 @else border-gray-300 @enderror px-4 py-2 rounded-md bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                    @error('redirect_uri')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-between pt-6">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow transition-all">
                        Simpan
                    </button>

                    <a href="{{ route('admin.google-auth.test') }}"
                        class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md shadow transition-all">
                        🔍 Tes Koneksi
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
