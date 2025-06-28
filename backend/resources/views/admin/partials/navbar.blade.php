 <header
     class="fixed top-0 left-0 right-0 z-30 bg-primary text-white p-4 shadow flex items-center justify-between md:ml-64">
     <div class="flex items-center gap-3">
         <!-- Hamburger -->
         <button @click="sidebarOpen = true" class="md:hidden focus:outline-none">
             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
             </svg>
         </button>
         <h1 class="text-base md:text-xl font-semibold">Dashboard Nasabah</h1>
     </div>
     <div x-data="{ open: false }" class="relative inline-flex items-center gap-2 cursor-pointer select-none">
         <img src="{{ Auth::user()->avatar ?? '/default-avatar.png' }}" alt="Avatar"
             class="w-8 h-8 rounded-full object-cover" @click="open = !open" />

         <!-- Nama user -->
         <span @click="open = !open" class="text-white text-sm font-medium select-none">
             {{ Auth::user()->name }}
         </span>

         <span @click="open = !open" class="material-icons text-white text-sm select-none">arrow_drop_down</span>

         <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="absolute right-0 top-full mt-1 w-40 rounded shadow-lg z-50 text-white bg-[#0c4a8f] border border-[#07437a] overflow-hidden"
             style="display: none;">
             <a href="#" class="block px-4 py-2 hover:bg-[#1351b4] transition rounded">Profil</a>
             <a href="#" class="block px-4 py-2 hover:bg-[#1351b4] transition rounded">Pengaturan</a>
             <form method="POST" action="{{ secure_url(route('logout', [], false)) }}">
                 @csrf
                 <button type="submit"
                     class="w-full text-left px-4 py-2 hover:bg-[#1351b4] transition rounded">Logout</button>
             </form>
         </div>
     </div>

 </header>
