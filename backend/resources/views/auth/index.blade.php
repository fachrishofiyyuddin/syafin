<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - SyaFin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --primary: #01356a;
            --primary-light: #0b4a8f;
        }

        .bg-primary {
            background-color: var(--primary);
        }

        .text-primary {
            color: var(--primary);
        }
    </style>
</head>

<body class="h-full bg-gray-100 flex items-center justify-center px-4">

    <div class="bg-white shadow-xl rounded-xl overflow-hidden flex max-w-4xl w-full animate-fade-in"
        x-data="{ showPassword: false }">
        <!-- Left Side (Image or Illustration) -->
        <div class="hidden md:flex items-center justify-center w-1/2 bg-primary text-white p-8">
            <div class="text-center space-y-4">
                <img src="assets/img/syafin-white.png" alt="Logo SyaFin" class="h-20 mx-auto">
                <h2 class="text-2xl font-bold">Selamat Datang Kembali</h2>
                <p class="text-sm">Login untuk mengakses layanan keuangan Syariah terbaik</p>
            </div>
        </div>

        <!-- Right Side (Form) -->
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-semibold text-primary mb-6">Login Akun Anda</h2>

            <form action="{{ secure_url(route('post.login', [], false)) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium mb-1">Username</label>
                    <input id="username" type="text" name="username" placeholder="Masukkan Username"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary transition duration-200"
                        required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <div class="relative">
                        <input id="password" :type="showPassword ? 'text' : 'password'" name="password"
                            placeholder="Masukkan Password"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary transition duration-200 pr-10"
                            required>
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute right-3 top-2.5 text-gray-500 focus:outline-none">
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 013.25-4.618M9.88 9.88A3 3 0 0112 9c.45 0 .875.1 1.25.28M15 15l2.292 2.292m0 0L21 21m-3.708-3.708L15 15zm-4.707-4.707a1 1 0 011.414 0L15 12.586m0 0l3.707 3.707m-3.707-3.707L9.88 9.88M6.707 6.707L3 3" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="bg-primary text-white w-full py-2 rounded-lg hover:bg-primary-light transition duration-200">
                    Masuk
                </button>

                <div class="mt-4 text-center">
                    <a href="/" class="text-sm text-primary hover:underline">
                        ← Kembali ke Landing Page
                    </a>
                </div>
            </form>
        </div>

    </div>

</body>

</html>
