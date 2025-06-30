<!-- Navbar -->
<nav class="fixed top-0 w-full bg-white/90 backdrop-blur-sm shadow-sm z-50">
    <div class="container mx-auto flex justify-between items-center py-5 px-6 md:px-12">
        <!-- Logo -->
        <a href="#" class="text-[var(--primary)] font-extrabold text-2xl tracking-wide flex items-center gap-2">
            <img src="assets/img/syafin-logo.png" alt="SyaFin" class="h-14 w-auto">
        </a>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex space-x-12 text-gray-700 font-semibold items-center">
            <li>
                <a href="#features" class="flex items-center gap-2 hover:text-[var(--primary)] transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L4.5 12.75 9.75 8.5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 17L19.5 12.75 14.25 8.5" />
                    </svg>
                    Fitur
                </a>
            </li>
            <li>
                <a href="#tracking" class="flex items-center gap-2 hover:text-[var(--primary)] transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16l4-4-4-4M7 12h14" />
                    </svg>
                    Tracking
                </a>
            </li>
            <li>
                <a href="#education" class="flex items-center gap-2 hover:text-[var(--primary)] transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.84 5.942L12 21l-7-3.48a12.06 12.06 0 01.84-5.942L12 14z" />
                    </svg>
                    FAQ
                </a>
            </li>
            <li>
                <a href="{{ route('login') }}" class="flex items-center gap-2 hover:text-[var(--primary)] transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A11.95 11.95 0 0112 15c2.21 0 4.269.636 5.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Login Admin
                </a>
            </li>
            <li>
                <a href="#form"
                    class="flex items-center gap-2 bg-gradient-to-r from-[var(--primary)] to-[var(--primary-light)] text-white rounded-full px-5 py-[6px] hover:opacity-90 transition font-semibold">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Ajukan Sekarang
                </a>
            </li>
        </ul>

        <!-- Mobile Menu Button -->
        <button id="menu-btn" class="md:hidden text-[var(--primary)] focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12" />
                <line x1="3" y1="6" x2="21" y2="6" />
                <line x1="3" y1="18" x2="21" y2="18" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-sm px-6 py-8 shadow-md">
        <ul class="space-y-6 text-gray-700 font-semibold">
            <li>
                <a href="#features" class="flex items-center gap-2 hover:text-[var(--primary)] transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L4.5 12.75 9.75 8.5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 17L19.5 12.75 14.25 8.5" />
                    </svg>
                    Fitur
                </a>
            </li>
            <li>
                <a href="#tracking" class="flex items-center gap-2 hover:text-[var(--primary)] transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16l4-4-4-4M7 12h14" />
                    </svg>
                    Tracking
                </a>
            </li>
            <li>
                <a href="#education" class="flex items-center gap-2 hover:text-[var(--primary)] transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.84 5.942L12 21l-7-3.48a12.06 12.06 0 01.84-5.942L12 14z" />
                    </svg>
                    FAQ
                </a>
            </li>
            <li>
                <a href="{{ route('login') }}" class="flex items-center gap-2 hover:text-[var(--primary)] transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A11.95 11.95 0 0112 15c2.21 0 4.269.636 5.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Login
                </a>
            </li>
            <li>
                <a href="#form"
                    class="flex items-center justify-center gap-2 bg-gradient-to-r from-[var(--primary)] to-[var(--primary-light)] text-white rounded-full px-6 py-3 text-center font-semibold hover:opacity-90 transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Ajukan Sekarang
                </a>
            </li>
        </ul>
    </div>
</nav>
