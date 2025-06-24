<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SyaFin by Bank Jateng Syariah</title>
    <!-- Meta Tag SEO -->
    <meta name="description"
        content="SyaFin adalah solusi keuangan syariah dari Bank Jateng Syariah. Ajukan kebutuhan keuangan online mudah, aman, dan cepat.">
    <meta name="keywords" content="syariah, keuangan syariah, kebutuhan keuangan online, Bank Jateng Syariah, SyaFin">
    <meta name="author" content="Bank Jateng Syariah">
    <meta name="robots" content="index, follow">

    <!-- Open Graph (saat dishare di sosial media) -->
    <meta property="og:title" content="SyaFin by Bank Jateng Syariah" />
    <meta property="og:description"
        content="Ajukan kebutuhan keuangan syariah online dengan mudah dan aman bersama SyaFin." />
    <meta property="og:image" content="assets/img/syafin-logo.png" />
    <meta property="og:url" content="https://syafin-fachrishofiyyuddins-projects.vercel.app/" />
    <meta property="og:type" content="website" />

    <!-- Favicon & Icons -->
    <link rel="icon" href="assets/img/syafin-logo.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="assets/img/syafin-logo.png" />
    <link rel="shortcut icon" href="assets/img/syafin-logo.png" type="image/png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Tambahkan link CSS Swiper di <head> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        :root {
            --primary: #01356a;
            --primary-light: #0b4a8f;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Animasi fade-up untuk section */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        .animate-blink {
            animation: blink 1s step-start infinite;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-white text-gray-900">

    @include('landing.partials.navbar')

    @yield('content')

    @include('landing.partials.footer')

    <script>
        // Mobile menu toggle
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Fade-up animation on scroll
        const fadeElements = document.querySelectorAll('.fade-up');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
        });

        fadeElements.forEach(el => observer.observe(el));

        const slider = document.getElementById('hero-slider');
        const slides = slider.querySelectorAll('img');
        const dots = document.querySelectorAll('[data-index]');
        let index = 0;

        function updateSlider() {
            slider.style.transform = `translateX(-${index * 100}%)`;
            dots.forEach(dot => dot.classList.remove('opacity-100'));
            dots[index].classList.add('opacity-100');
        }

        // Auto Slide
        setInterval(() => {
            index = (index + 1) % slides.length;
            updateSlider();
        }, 4000);

        // Dot click
        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                index = parseInt(dot.getAttribute('data-index'));
                updateSlider();
            });
        });

        // Initial state
        updateSlider();
    </script>

    <!-- Floating Chat CS with Human/Chatbot Info (Bubble tetap tampil) -->
    <div x-data="{ open: false, showBubble: true }" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">

        <!-- Bubble Text -->
        <div x-show="showBubble" x-transition.duration.500ms
            class="bg-green-500 text-white px-4 py-2 rounded-full shadow mb-2 text-sm animate-pulse cursor-pointer"
            @click="open = true">
            Butuh Konsultasi? Klik sini!
        </div>

        <!-- Chat Icon (Lottie) -->
        <button @click="open = !open"
            class="bg-white rounded-full shadow-lg hover:bg-gray-100 focus:outline-none transition">
            <lottie-player src="assets/lottie/wa_animation.json" background="transparent" speed="1"
                style="width: 60px; height: 60px;" loop autoplay>
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
                <a href="https://t.me/nama_bot_anda" target="_blank"
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

    <!-- Include Lottie player -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- Optional: Notifikasi Suara -->
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <audio id="ping-sound" src="https://assets.mixkit.co/sfx/preview/mixkit-bell-notification-933.mp3"></audio>
    <script>
        // Play ping sound 2 sec after page load
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('ping-sound').play();
            }, 2000);
        });

        document.addEventListener("DOMContentLoaded", () => {
            const text = "Mudah dan Transparan";
            const typingTarget = document.getElementById("typing-text");
            const cursor = document.getElementById("cursor");

            const isMobile = window.innerWidth < 640; // sm breakpoint Tailwind

            if (isMobile) {
                typingTarget.textContent = text;
                if (cursor) cursor.style.display = "none";
            } else {
                let index = 0;
                let isDeleting = false;

                function loopTyping() {
                    if (isDeleting) {
                        typingTarget.textContent = text.substring(0, index--);
                    } else {
                        typingTarget.textContent = text.substring(0, index++);
                    }

                    if (!isDeleting && index === text.length + 1) {
                        setTimeout(() => isDeleting = true, 800);
                    } else if (isDeleting && index < 0) {
                        isDeleting = false;
                    }

                    const delay = isDeleting ? 50 : 100;
                    setTimeout(loopTyping, delay);
                }

                loopTyping();
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('trackingForm');
            const inputField = form.querySelector('input[name="trackingNumber"]');
            const resultsDiv = document.getElementById('searchResults');
            const resultsBody = document.getElementById('resultsBody');
            const spinner = document.getElementById('loadingSpinner');
            const wrapper = document.getElementById('trackingWrapper');

            form.addEventListener('submit', e => {
                e.preventDefault();
                const nomor = inputField.value.trim();

                if (!nomor) {
                    wrapper?.classList.add('hidden');
                    spinner.classList.add('hidden');
                    resultsDiv.classList.add('hidden');
                    resultsBody.innerHTML = '';
                    alert('Masukkan nomor pengajuan terlebih dahulu!');
                    return; // ⛔ STOP di sini
                }

                wrapper?.classList.remove('hidden');
                spinner.classList.remove('hidden');
                resultsDiv.classList.add('hidden');
                resultsBody.innerHTML = '';

                setTimeout(() => {
                    const exampleData = [{
                        nomor: nomor,
                        tanggal: '20 Juni 2025',
                        status: 'Disetujui',
                        keterangan: 'Dana akan cair dalam 3 hari kerja'
                    }];

                    exampleData.forEach(item => {
                        const row = document.createElement('tr');
                        row.classList.add('hover:bg-gray-50');
                        row.innerHTML = `
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.nomor}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${item.tanggal}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">${item.status}</td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${item.keterangan}</td>
        `;
                        resultsBody.appendChild(row);
                    });

                    spinner.classList.add('hidden');
                    resultsDiv.classList.remove('hidden');
                }, 1500);
            });

            inputField.addEventListener('input', () => {
                if (inputField.value.trim() === '') {
                    wrapper?.classList.add('hidden');
                    spinner.classList.add('hidden');
                    resultsDiv.classList.add('hidden');
                    resultsBody.innerHTML = '';
                }
            });
        });

        const swiper = new Swiper(".mySwiper", {
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            slidesPerView: 1,
            spaceBetween: 20,
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>


</body>

</html>
