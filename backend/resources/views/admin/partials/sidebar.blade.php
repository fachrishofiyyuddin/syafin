<!-- Sidebar -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed md:relative z-50 top-0 left-0 w-64 h-full md:h-auto bg-primary-light text-white transform transition-transform duration-300 md:translate-x-0 md:flex flex-col p-4 md:w-64">

    <div class="flex flex-col h-full">
        <div>
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/img/syafin-white.png') }}" alt="Logo" class="w-32" />
            </div>
            <nav class="space-y-2">
                <!-- Menu Home selalu ada -->
                <a href="{{ route('dashboards') }}" class="block py-2 px-3 rounded hover:bg-primary text-sm">Home</a>

                <!-- Menampilkan menu untuk admin -->
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('bot.commands.index') }}"
                        class="block py-2 px-3 rounded hover:bg-primary text-sm">Bot Commands</a>
                    <a href="{{ route('admin.google-auth.index') }}"
                        class="block py-2 px-3 rounded hover:bg-primary text-sm">Google Auth</a>
                    <a href="{{ route('admin.telegram.index') }}"
                        class="block py-2 px-3 rounded hover:bg-primary text-sm">Telegram</a>
                    <a href="{{ route('admin.midtrans.index') }}"
                        class="block py-2 px-3 rounded hover:bg-primary text-sm">Midtrans</a>
                @endif
            </nav>
        </div>

        <!-- Footer di bawah -->
        <p class="text-xs text-center border-t border-white/30 pt-4 mt-auto">© 2025 Bank Jateng Syariah</p>
    </div>
</aside>
