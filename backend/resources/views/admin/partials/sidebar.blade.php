<!-- Sidebar -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed md:relative z-50 top-0 left-0 w-64 h-full md:h-auto bg-primary-light text-white transform transition-transform duration-300 md:translate-x-0 md:flex flex-col p-4 md:w-64">

    <div class="flex flex-col h-full">
        <div>
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/img/syafin-white.png') }}" alt="Logo" class="w-32" />
            </div>
            <nav class="space-y-2">
                <a href="{{ route('dashboards') }}" class="block py-2 px-3 rounded hover:bg-primary text-sm">Home</a>
                <!-- Ganti Setting FAQ menjadi Setting Bot Commands -->
                <a href="{{ route('bot.commands.index') }}"
                    class="block py-2 px-3 rounded hover:bg-primary text-sm">Setting
                    Bot Commands</a>
            </nav>
        </div>

        <!-- Footer di bawah -->
        <p class="text-xs text-center border-t border-white/30 pt-4 mt-auto">© 2025 Bank Syariah</p>
    </div>
</aside>
