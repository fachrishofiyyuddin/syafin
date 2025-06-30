@extends('admin.layouts.app')

@section('content')
    <div class="bg-gray-50 min-h-screen flex justify-center items-center py-10">
        <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md transform transition-all duration-300 hover:scale-105">
            <div class="flex justify-center mb-6">
                <!-- Gambar Profil dengan animasi hover -->
                <img src="{{ Auth::user()->avatar ? Auth::user()->avatar : asset('assets/img/profile.png') }}"
                    alt="Profile Picture"
                    class="w-32 h-32 rounded-full border-4 border-teal-400 shadow-xl transition-all duration-300 transform hover:scale-110 hover:shadow-2xl">
            </div>

            <div class="text-center space-y-4">
                <!-- Nama Pengguna dengan font lebih besar -->
                <h2 class="text-4xl font-extrabold text-gray-800">{{ $user['name'] }}</h2>
                <p class="text-lg text-teal-600 font-medium">{{ $user['role'] ?? 'Nasabah' }}</p>

                <!-- Informasi Kontak dengan icon dan padding lebih luas -->
                <div class="space-y-3 mt-4 text-gray-700">
                    <div class="flex items-center justify-center gap-3">
                        <span class="material-icons text-teal-600">mail</span>
                        <p class="text-sm text-gray-800">{{ $user['email'] }}</p>
                    </div>
                    <div class="flex items-center justify-center gap-3">
                        <span class="material-icons text-teal-600">phone</span>
                        <p class="text-sm text-gray-800">{{ $user['phone'] ?? 'Tidak ada' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
