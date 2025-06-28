<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Berhasil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen font-sans">

    <div class="bg-white p-6 rounded-md shadow-lg text-center w-72">
        <!-- Ikon Check -->
        <div class="mb-4">
            <svg class="w-12 h-12 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <!-- Teks -->
        <h2 class="text-xl font-semibold text-gray-800 mb-4 animate__animated animate__fadeIn">Login Berhasil!</h2>
        <p class="text-sm text-gray-600 animate__animated animate__fadeIn animate__delay-1s">Anda akan segera
            diarahkan ke dashboard...</p>
    </div>

    <script>
        setTimeout(() => {
            window.location.href = "{{ $redirectTo }}";
        }, 1500); // Redirect setelah 1.5 detik
    </script>

</body>

</html>
