 @extends('landing.layouts.app')

 @section('content')
     <section
         class="relative pt-20 bg-gradient-to-b from-[var(--primary)] to-[var(--primary-light)] text-white text-center overflow-hidden min-h-screen">
         <!-- Background image overlay -->
         <div class="absolute inset-0 z-0">
             <img src="assets/img/1.png" alt="Background" class="w-full h-full object-cover object-center opacity-30" />
             <div class="absolute inset-0 bg-[rgba(3,57,113,0.6)]"></div> <!-- overlay warna biru transparan -->
         </div>

         <div
             class="relative z-10 w-full max-w-screen-lg mx-auto px-4 sm:px-6 md:px-8 min-h-screen flex flex-col justify-center items-center space-y-8">

             <h1
                 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extralight leading-tight tracking-tight drop-shadow-lg text-center">
                 Keuangan Syariah<br />
                 <span class="font-semibold block">
                     <span id="typing-text" class="block sm:inline whitespace-normal sm:whitespace-nowrap">
                         Mudah dan Transparan
                     </span>
                     <span id="cursor" class="inline-block animate-blink sm:inline hidden sm:inline-block">|</span>
                 </span>
             </h1>

             <p
                 class="text-lg sm:text-xl md:text-2xl font-semibold uppercase tracking-wide text-white/90 flex justify-center items-center gap-3 flex-wrap">
                 Solusi
                 <span
                     class="bg-yellow-400 text-black px-4 py-1 rounded-md shadow-lg font-bold inline-flex items-center gap-2 animate-pulse">
                     💸 KEBUTUHAN KEUANGAN ONLINE
                 </span>
                 Mudah & Cepat
             </p>

             <p class="text-base sm:text-lg md:text-xl max-w-2xl mx-auto opacity-95 drop-shadow-md">
                 Ajukan kebutuhan keuangan secara <span class="font-semibold underline decoration-yellow-400">online</span>,
                 tanpa ribet dan proses cepat.
                 Pantau status pengajuan secara real-time, konsultasi kapan saja dengan tim kami.
             </p>

             <a href="#form"
                 class="group relative inline-flex items-center gap-2 px-8 py-3 bg-white text-[var(--primary)] font-semibold rounded-full
            shadow-md overflow-hidden
            transition-all duration-500 ease-in-out
            hover:text-black
            active:scale-95 active:shadow-inner">
                 <!-- Background fill efek -->
                 <span
                     class="absolute inset-0 bg-yellow-400 scale-x-0 origin-left transition-transform duration-500 ease-in-out group-hover:scale-x-100 rounded-full z-0"></span>

                 <!-- Icon -->
                 <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-yellow-400 transition-colors duration-500 ease-in-out group-hover:text-black z-10 relative"
                     fill="currentColor" viewBox="0 0 20 20">
                     <path d="M11 0h3l-4 9h4l-6 11v-9H5l6-11z" />
                 </svg>

                 <!-- Teks -->
                 <span class="relative z-10 text-base">Ajukan Sekarang</span>
             </a>
         </div>
     </section>


     <section id="education" class="scroll-mt-28 bg-gray-50 py-20 fade-up">
         <div class="container mx-auto px-6 md:px-12 max-w-5xl">
             <h2 class="text-4xl font-extrabold text-[var(--primary)] mb-16 text-center">Pertanyaan yang sering diajukan
                 (FAQ)</h2>

             <!-- FAQ List -->
             <div class="space-y-6 mb-16">
                 <details class="bg-white rounded-lg shadow-md p-6 cursor-pointer hover:shadow-xl transition-shadow group"
                     open>
                     <summary
                         class="flex items-center justify-between font-semibold text-lg text-[var(--primary)] select-none">
                         Apa itu kebutuhan keuangan online?
                         <span class="transition-transform duration-300 group-open:rotate-45 text-[var(--primary)]">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                             </svg>
                         </span>
                     </summary>
                     <p class="mt-3 text-gray-700 leading-relaxed">
                         Kebutuhan keuangan online adalah proses pengajuan dana yang dilakukan secara digital melalui
                         platform atau aplikasi tanpa harus datang langsung ke kantor. Proses ini lebih cepat, fleksibel,
                         dan dapat diakses kapan saja.
                     </p>
                 </details>

                 <details class="bg-white rounded-lg shadow-md p-6 cursor-pointer hover:shadow-xl transition-shadow group">
                     <summary
                         class="flex items-center justify-between font-semibold text-lg text-[var(--primary)] select-none">
                         Apa saja jenis pengajuan kebutuhan keuangan online?
                         <span class="transition-transform duration-300 group-open:rotate-45 text-[var(--primary)]">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                             </svg>
                         </span>
                     </summary>
                     <p class="mt-3 text-gray-700 leading-relaxed">
                         Terdapat beberapa jenis pengajuan yang bisa dipilih sesuai kebutuhan Anda:
                     <ul class="list-disc list-inside mt-2 space-y-1">
                         <li><strong>Kebutuhan Konsumtif</strong> – untuk keperluan pribadi seperti liburan, gadget,
                             pernikahan, dll.</li>
                         <li><strong>Kebutuhan Produktif</strong> – untuk mendukung usaha, modal kerja, atau investasi
                             bisnis.</li>
                         <li><strong>Kebutuhan Darurat</strong> – untuk situasi mendesak seperti biaya kesehatan,
                             bencana, atau kehilangan pendapatan.</li>
                     </ul>
                     </p>
                 </details>

                 <details class="bg-white rounded-lg shadow-md p-6 cursor-pointer hover:shadow-xl transition-shadow group">
                     <summary
                         class="flex items-center justify-between font-semibold text-lg text-[var(--primary)] select-none">
                         Bagaimana cara mengajukan kebutuhan keuangan online?
                         <span class="transition-transform duration-300 group-open:rotate-45 text-[var(--primary)]">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                             </svg>
                         </span>
                     </summary>
                     <p class="mt-3 text-gray-700 leading-relaxed">Anda dapat mengajukan kebutuhan keuangan online dengan
                         terlebih dahulu login menggunakan akun email atau Google. Setelah berhasil login, silakan isi
                         formulir pengajuan di website atau aplikasi kami, lalu ikuti proses verifikasi dan persetujuan
                         secara digital</p>
                 </details>

                 <details class="bg-white rounded-lg shadow-md p-6 cursor-pointer hover:shadow-xl transition-shadow group">
                     <summary
                         class="flex items-center justify-between font-semibold text-lg text-[var(--primary)] select-none">
                         Berapa lama proses pencairan dana?
                         <span class="transition-transform duration-300 group-open:rotate-45 text-[var(--primary)]">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                             </svg>
                         </span>
                     </summary>
                     <p class="mt-3 text-gray-700 leading-relaxed">Proses pencairan dana biasanya memakan waktu antara 1
                         sampai 3 hari kerja setelah pengajuan disetujui dan dokumen lengkap.</p>
                 </details>

                 <details class="bg-white rounded-lg shadow-md p-6 cursor-pointer hover:shadow-xl transition-shadow group">
                     <summary
                         class="flex items-center justify-between font-semibold text-lg text-[var(--primary)] select-none">
                         Apa itu plafon kebutuhan keuangan online?
                         <span class="transition-transform duration-300 group-open:rotate-45 text-[var(--primary)]">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                             </svg>
                         </span>
                     </summary>
                     <p class="mt-3 text-gray-700 leading-relaxed">
                         Plafon kebutuhan keuangan online adalah batas maksimum dana yang dapat diajukan oleh pengguna
                         berdasarkan
                         kriteria tertentu seperti riwayat kredit, penghasilan, dan tujuan pengajuan. Plafon ini ditentukan
                         oleh
                         penyedia layanan untuk memastikan kemampuan pembayaran pengguna tetap terjaga dan risiko kredit
                         dapat diminimalkan.
                     </p>
                 </details>

                 <details class="bg-white rounded-lg shadow-md p-6 cursor-pointer hover:shadow-xl transition-shadow group">
                     <summary
                         class="flex items-center justify-between font-semibold text-lg text-[var(--primary)] select-none">
                         Apakah ada risiko kebutuhan keuangan online?
                         <span class="transition-transform duration-300 group-open:rotate-45 text-[var(--primary)]">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                             </svg>
                         </span>
                     </summary>
                     <p class="mt-3 text-gray-700 leading-relaxed">Seperti layanan keuangan lainnya, kebutuhan keuangan
                         online memiliki risiko seperti keterlambatan pembayaran atau penipuan. Pastikan untuk memilih
                         platform resmi dan membaca syarat ketentuan dengan teliti.</p>
                 </details>
             </div>

             <!-- Videos Section -->
             <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                 <div class="w-full aspect-video rounded-xl overflow-hidden shadow-lg border border-gray-200">
                     <iframe src="https://www.youtube.com/embed/tYZIU1UAMaM?si=C8vNic_dtFc9QHKm"
                         title="Video Edukasi Kebutuhan Keuangan Online 1" frameborder="0"
                         allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                         allowfullscreen class="w-full h-full"></iframe>
                 </div>

                 <div class="w-full aspect-video rounded-xl overflow-hidden shadow-lg border border-gray-200">
                     <iframe src="https://www.youtube.com/embed/tYZIU1UAMaM?si=C8vNic_dtFc9QHKm"
                         title="Video Edukasi Kebutuhan Keuangan Online 2" frameborder="0"
                         allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                         allowfullscreen class="w-full h-full"></iframe>
                 </div>
             </div>
         </div>
     </section>

     <!-- Form Pengajuan Section -->
     <section id="form" class="scroll-mt-28 relative py-24 fade-up">
         <!-- Background Image Overlay -->
         <div class="absolute inset-0 z-0">
             <img src="assets/img/bg-loan.jpg" alt="Background Form" class="w-full h-full object-cover object-center" />
             <div class="absolute inset-0 bg-gradient-to-br from-black/50 via-black/40 to-black/60 backdrop-blur-sm"></div>
         </div>

         <!-- Content -->
         <div class="relative z-10 container mx-auto px-6 md:px-8 max-w-xl">
             <div
                 class="bg-white/80 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-10 sm:p-12 animate-fade-in-up transition duration-500 ease-in-out">

                 <h2 class="text-4xl sm:text-5xl font-extrabold text-[var(--primary)] text-center mb-8 drop-shadow-sm">
                     Ajukan Sekarang
                 </h2>

                 @if (session('success'))
                     <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg text-center shadow-md">
                         {{ session('success') }}
                     </div>
                 @endif

                 <!-- Tombol login -->
                 <div class="text-center mt-6 space-y-4">
                     <!-- Login Google -->
                     <a href="{{ secure_url(route('google.login', [], false)) }}"
                         class="inline-flex items-center justify-center gap-3 px-7 py-4 bg-white border border-gray-200 rounded-full shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 ease-in-out">
                         <!-- Ikon Google -->
                         <svg class="w-5 h-5" viewBox="0 0 48 48">
                             <path fill="#EA4335"
                                 d="M24 9.5c3.2 0 5.9 1.1 8 3.2l6-6C34.7 2.4 29.7 0 24 0 14.8 0 6.9 5.5 2.8 13.3l7 5.4C12.2 13 17.6 9.5 24 9.5z" />
                             <path fill="#4285F4"
                                 d="M46.1 24.5c0-1.6-.1-3.1-.4-4.6H24v9h12.4c-.5 2.6-2.1 4.9-4.6 6.4l7.2 5.5C43.8 36.4 46.1 30.9 46.1 24.5z" />
                             <path fill="#FBBC05" d="M10.3 28.6c-1-2.8-1-5.8 0-8.6l-7-5.4c-2.7 5.3-2.7 11.7 0 17l7-5.4z" />
                             <path fill="#34A853"
                                 d="M24 48c5.7 0 10.5-1.9 14-5.2l-7.2-5.5c-2 1.4-4.5 2.2-6.8 2.2-6.4 0-11.8-4.4-13.7-10.4l-7 5.4C6.9 42.5 14.8 48 24 48z" />
                             <path fill="none" d="M0 0h48v48H0z" />
                         </svg>
                         <span class="text-sm sm:text-base font-semibold text-gray-800">Masuk dengan Google</span>
                     </a>

                     <!-- Login Telegram -->
                     <div class="flex justify-center">
                         <script async src="https://telegram.org/js/telegram-widget.js?7" data-telegram-login="HelloSyvaBot" data-size="large"
                             data-radius="50" data-userpic="false" data-auth-url="{{ secure_url(route('telegram.auth', [], false)) }}"
                             data-request-access="write"></script>

                     </div>

                     <p class="text-xs sm:text-sm text-gray-600 mt-2">Gunakan akun Google atau Telegram untuk login dan
                         ajukan
                         kebutuhan keuangan.</p>
                 </div>


             </div>
         </div>
     </section>

     <!-- Features Section -->
     <section id="features" class="scroll-mt-28 container mx-auto px-6 md:px-12 py-20 fade-up min-h-[600px]">
         <h2 class="text-4xl font-extrabold text-[var(--primary)] mb-16 text-center">Fitur Utama SyaFin</h2>
         <div class="grid md:grid-cols-3 gap-12">

             <div class="bg-white rounded-3xl shadow-lg p-10 flex flex-col items-center text-center hover:shadow-2xl transition-shadow duration-300 hover:scale-[1.05] cursor-pointer"
                 style="animation-delay: 0s;">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mb-6 text-[var(--primary)]" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6m-7 3a7 7 0 1114 0H5z" />
                 </svg>
                 <h3 class="text-2xl font-semibold mb-3">Pengajuan Mudah dan Cepat</h3>
                 <p class="text-gray-700 max-w-xs">Ajukan kebutuhan keuangan secara online tanpa ribet, proses langsung
                     cepat tanpa antre.</p>
             </div>

             <div class="bg-white rounded-3xl shadow-lg p-10 flex flex-col items-center text-center hover:shadow-2xl transition-shadow duration-300 hover:scale-[1.05] cursor-pointer"
                 style="animation-delay: 0.15s;">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mb-6 text-[var(--primary)]" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18" />
                     <path stroke-linecap="round" stroke-linejoin="round" d="M8 21V7h8v14" />
                 </svg>
                 <h3 class="text-2xl font-semibold mb-3">Pantauan Status Real-Time</h3>
                 <p class="text-gray-700 max-w-xs">Lacak perkembangan pengajuan kamu kapan saja langsung dari aplikasi
                     atau website.</p>
             </div>

             <div class="bg-white rounded-3xl shadow-lg p-10 flex flex-col items-center text-center hover:shadow-2xl transition-shadow duration-300 hover:scale-[1.05] cursor-pointer"
                 style="animation-delay: 0.3s;">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mb-6 text-[var(--primary)]" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                 </svg>
                 <h3 class="text-2xl font-semibold mb-3">Konsultasi Ahli 24/7</h3>
                 <p class="text-gray-700 max-w-xs">Dapatkan solusi cepat dari tim profesional melalui chat online kapan
                     saja.</p>
             </div>

         </div>
     </section>

     <section id="tracking" class="scroll-mt-28 relative bg-gray-50 py-20 fade-up min-h-[600px]">
         <!-- Background Image Overlay -->
         <div class="absolute inset-0 z-0">
             <img src="assets/img/bg-tracking.jpg" alt="Background Tracking"
                 class="w-full h-full object-cover object-top" />
             <div class="absolute inset-0 bg-black/30"></div>
         </div>

         <div class="relative z-10 container mx-auto px-6 md:px-12 text-center max-w-3xl">
             <h2 class="text-4xl font-extrabold text-[var(--primary)] mb-8">Pantau Pengajuan Anda</h2>

             <p class="mb-8 text-white bg-[#033971]/90 px-6 py-4 rounded-xl">
                 Silakan masukkan <span class="font-semibold text-yellow-300">nomor pengajuan</span> Anda untuk mengecek
                 status terkini dari proses <span class="font-semibold text-yellow-300">peminjaman dana</span>.
                 Informasi akan ditampilkan secara real-time setelah Anda klik tombol <strong>"Lacak"</strong>.
             </p>

             <form id="trackingForm" class="flex flex-col md:flex-row gap-3 max-w-md mx-auto mb-12">
                 <input type="text" name="trackingNumber" placeholder="Nomor Pengajuan"
                     class="w-full px-4 py-3 rounded-lg bg-white/80 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 shadow-inner transition-all duration-300" />
                 <button type="submit"
                     class="w-full md:w-auto bg-[var(--primary)] text-white rounded-lg px-6 py-3 font-semibold hover:bg-yellow-400 hover:text-black transition-all duration-300 shadow-md hover:shadow-xl hover:scale-105 flex items-center gap-2 justify-center">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                         <path stroke-linecap="round" stroke-linejoin="round"
                             d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                     </svg>
                     Lacak
                 </button>
             </form>

             <!-- Wrapper untuk hasil tracking -->
             <div id="trackingWrapper"
                 class="hidden bg-white/70 backdrop-blur-md rounded-xl p-6 mt-10 shadow-lg transition-all duration-500">

                 <!-- Spinner loading -->
                 <div id="loadingSpinner" class="flex items-center justify-center gap-4 mb-8">
                     <svg class="animate-spin h-7 w-7 text-[var(--primary)]" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24">
                         <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                             stroke-width="4"></circle>
                         <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                     </svg>
                     <span class="text-[var(--primary)] text-lg font-semibold">Sedang memuat...</span>
                 </div>

                 <!-- Hasil Pencarian -->
                 <div id="searchResults" class="text-left hidden">
                     <h3 class="text-2xl font-bold mb-6 text-[var(--primary)]">Hasil Pencarian</h3>
                     <div class="overflow-x-auto rounded-xl shadow-md border border-gray-200 bg-white">
                         <table class="min-w-full text-sm text-left">
                             <thead class="bg-[var(--primary)] text-white">
                                 <tr>
                                     <th class="px-6 py-4 font-semibold uppercase tracking-wide">Nomor</th>
                                     <th class="px-6 py-4 font-semibold uppercase tracking-wide">Tanggal</th>
                                     <th class="px-6 py-4 font-semibold uppercase tracking-wide">Status</th>
                                     <th class="px-6 py-4 font-semibold uppercase tracking-wide">Status Verifikasi</th>
                                 </tr>
                             </thead>
                             <tbody id="resultsBody" class="divide-y divide-gray-200">
                                 <!-- Data hasil dari JS akan ditambahkan di sini -->
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>


         </div>
     </section>

     <!-- Testimonial Section -->
     <section id="testimonials" class="scroll-mt-28 bg-gray-100 py-20 fade-up min-h-[600px]">
         <div class="container mx-auto px-6 md:px-12">
             <h2 class="text-4xl font-extrabold text-[var(--primary)] mb-16 text-center">
                 Testimoni Nasabah
             </h2>

             <!-- Swiper -->
             <div class="swiper mySwiper">
                 <div class="swiper-wrapper">

                     <!-- Testimonial 1 -->
                     <div class="swiper-slide">
                         <div class="bg-gray-50 p-8 rounded-3xl shadow hover:shadow-lg transition duration-300">
                             <div class="flex items-center gap-4 mb-4">
                                 <img src="https://i.pravatar.cc/100?img=3" alt="Avatar"
                                     class="w-14 h-14 rounded-full border-2 border-[var(--primary)]" />
                                 <div>
                                     <p class="font-semibold text-lg text-[var(--primary)]">
                                         Aulia R.
                                     </p>
                                     <p class="text-sm text-gray-500">Pengusaha UMKM</p>
                                 </div>
                             </div>
                             <div class="flex text-yellow-400 mb-3">
                                 <!-- 5 stars -->
                                 <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                             </div>
                             <p class="text-gray-700 text-lg leading-relaxed">
                                 "Prosesnya cepat dan saya bisa lacak statusnya langsung dari
                                 rumah. SyaFin benar-benar membantu usaha saya."
                             </p>
                         </div>
                     </div>

                     <!-- Testimonial 2 -->
                     <div class="swiper-slide">
                         <div class="bg-gray-50 p-8 rounded-3xl shadow hover:shadow-lg transition duration-300">
                             <div class="flex items-center gap-4 mb-4">
                                 <img src="https://i.pravatar.cc/100?img=5" alt="Avatar"
                                     class="w-14 h-14 rounded-full border-2 border-[var(--primary)]" />
                                 <div>
                                     <p class="font-semibold text-lg text-[var(--primary)]">
                                         Rizky F.
                                     </p>
                                     <p class="text-sm text-gray-500">Karyawan Swasta</p>
                                 </div>
                             </div>
                             <div class="flex text-yellow-400 mb-3">
                                 <!-- 5 stars -->
                                 <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                             </div>
                             <p class="text-gray-700 text-lg leading-relaxed">
                                 "Pengajuan pembiayaan tanpa ribet, transparan, dan sesuai prinsip
                                 syariah. Sangat puas dengan layanan SyaFin."
                             </p>
                         </div>
                     </div>

                     <!-- Testimonial 3 -->
                     <div class="swiper-slide">
                         <div class="bg-gray-50 p-8 rounded-3xl shadow hover:shadow-lg transition duration-300">
                             <div class="flex items-center gap-4 mb-4">
                                 <img src="https://i.pravatar.cc/100?img=9" alt="Avatar"
                                     class="w-14 h-14 rounded-full border-2 border-[var(--primary)]" />
                                 <div>
                                     <p class="font-semibold text-lg text-[var(--primary)]">Dewi M.</p>
                                     <p class="text-sm text-gray-500">Freelancer</p>
                                 </div>
                             </div>
                             <div class="flex mb-3">
                                 <!-- 4 stars filled -->
                                 <svg class="w-5 h-5 fill-current text-yellow-400" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current text-yellow-400" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current text-yellow-400" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current text-yellow-400" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <!-- 1 star gray -->
                                 <svg class="w-5 h-5 fill-current text-gray-300" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                             </div>
                             <p class="text-gray-700 text-lg leading-relaxed">
                                 "Saya suka fitur konsultasi online-nya! CS sangat membantu dan
                                 responsif. Recomended banget."
                             </p>
                         </div>
                     </div>

                     <!-- Testimonial 3 -->
                     <div class="swiper-slide">
                         <div class="bg-gray-50 p-8 rounded-3xl shadow hover:shadow-lg transition duration-300">
                             <div class="flex items-center gap-4 mb-4">
                                 <img src="https://i.pravatar.cc/100?img=9" alt="Avatar"
                                     class="w-14 h-14 rounded-full border-2 border-[var(--primary)]" />
                                 <div>
                                     <p class="font-semibold text-lg text-[var(--primary)]">Dewi M.</p>
                                     <p class="text-sm text-gray-500">Freelancer</p>
                                 </div>
                             </div>
                             <div class="flex mb-3">
                                 <!-- 4 stars filled -->
                                 <svg class="w-5 h-5 fill-current text-yellow-400" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current text-yellow-400" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current text-yellow-400" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <svg class="w-5 h-5 fill-current text-yellow-400" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                                 <!-- 1 star gray -->
                                 <svg class="w-5 h-5 fill-current text-gray-300" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M10 15l-5.878 3.09L5.64 12.545.76 8.91l6.093-.884L10 2.5l3.147 5.526 6.093.884-4.88 3.636 1.518 5.545z" />
                                 </svg>
                             </div>
                             <p class="text-gray-700 text-lg leading-relaxed">
                                 "Saya suka fitur konsultasi online-nya! CS sangat membantu dan
                                 responsif. Recomended banget."
                             </p>
                         </div>
                     </div>

                 </div>

                 <!-- Navigation buttons -->
                 <div class="swiper-button-next text-[var(--primary)] hover:text-[var(--primary-dark)]"></div>
                 <div class="swiper-button-prev text-[var(--primary)] hover:text-[var(--primary-dark)]"></div>

                 <!-- Pagination -->
                 <div class="swiper-pagination mt-8"></div>
             </div>
         </div>
     </section>
 @endsection
