<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard SyaFin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Tambahkan CDN Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <style>
        :root {
            --primary: #01356a;
            --primary-light: #0b4a8f;
        }

        .bg-primary {
            background-color: var(--primary);
        }

        .bg-primary-light {
            background-color: var(--primary-light);
        }

        .text-primary {
            color: var(--primary);
        }
    </style>
</head>

<body class="bg-gray-100 h-full" x-data="{ sidebarOpen: false, modalOpen: false, commandModalOpen: false }">

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: true
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                html: `
            <ul style="text-align:left;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        `,
                showConfirmButton: true
            });
        </script>
    @endif
    <div class="flex flex-col md:flex-row min-h-screen">


        @include('admin.partials.sidebar')

        <!-- Overlay for mobile sidebar -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-40 z-40 md:hidden"></div>

        <!-- Main Content -->
        <main class="flex-1 p-4 space-y-6 pt-20">

            @include('admin.partials.navbar')

            @yield('content')

        </main>

        <!-- Floating Chat CS with Human/Chatbot Info (Bubble tetap tampil) -->
        <div x-data="{ open: false, showBubble: true }" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">

            <!-- Chat Icon (Lottie) -->
            <button @click="open = !open"
                class="bg-white rounded-full shadow-lg hover:bg-gray-100 focus:outline-none transition">
                <lottie-player src="{{ secure_asset('assets/lottie/wa_animation.json') }}" background="transparent"
                    speed="1" style="width: 60px; height: 60px;" loop autoplay>
                </lottie-player>
            </button>

            <!-- Chat Popup -->
            <div x-show="open" @click.away="open = false"
                class="bg-white border border-gray-300 shadow-lg rounded-lg p-4 w-72 mt-4 space-y-4">
                <h3 class="text-lg font-semibold">Pilih Cara Chat</h3>
                <p class="text-sm text-gray-600">Mau ngobrol langsung atau chatbot cepat?</p>

                <div class="space-y-3">
                    <!-- WhatsApp (Manusia) -->
                    <a href="https://wa.me/6281234567890?text=Halo%20CS%2C%20saya%20butuh%20bantuan." target="_blank"
                        class="flex items-center gap-2 bg-green-500 text-white py-2 px-3 rounded hover:bg-green-600 transition shadow">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M20.52 3.48A11.87 11.87 0 0012 0C5.37 0 0 5.37 0 12a11.91 11.91 0 001.68 6.07L0 24l6.22-1.62A11.9 11.9 0 0012 24c6.63 0 12-5.37 12-12a11.87 11.87 0 00-3.48-8.52z" />
                        </svg>
                        Chat CS Langsung
                    </a>

                    <!-- Telegram (Chatbot) -->
                    <a href="https://t.me/HelloSyvaBot" target="_blank"
                        class="flex items-center gap-2 bg-blue-500 text-white py-2 px-3 rounded hover:bg-blue-600 transition shadow">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M9.4 16.6l-.4 3.8c.6 0 .8-.3 1.1-.6l2.6-2.4 5.4 4c1 .5 1.8.2 2-.9l3.4-15.6c.4-1.7-.6-2.4-1.8-2L2.6 9.4c-1.6.6-1.6 1.6-.3 2l4.2 1.3 10.2-6.4c.5-.3 1-.2.6.2" />
                        </svg>
                        Chatbot Telegram
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Include Lottie player -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jatuhTempoField = document.getElementById('jatuh_tempo');
        const today = new Date();

        // Tambah 6 bulan
        const jatuhTempo = new Date(today);
        jatuhTempo.setMonth(jatuhTempo.getMonth() + 6);
        // Tambah 7 hari
        jatuhTempo.setDate(jatuhTempo.getDate() + 7);

        // Format ke dd-mm-yyyy
        const dd = String(jatuhTempo.getDate()).padStart(2, '0');
        const mm = String(jatuhTempo.getMonth() + 1).padStart(2, '0');
        const yyyy = jatuhTempo.getFullYear();
        jatuhTempoField.value = `${dd}-${mm}-${yyyy}`;
    });

    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        // Format: HH:MM:SS
        const timeString = `${hours}:${minutes}:${seconds}`;

        document.getElementById('clock').textContent = timeString;
    }

    setInterval(updateClock, 1000); // Update every second
    updateClock(); // Initial call to display time immediately
</script>


</html>
