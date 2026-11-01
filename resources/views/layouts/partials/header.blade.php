<header class="bg-surface h-20 flex items-center justify-between px-6 border-b border-border sticky top-0 z-10">
    <div class="flex items-center gap-4">
        <button id="menu-toggle" class="text-text-light hover:text-primary text-2xl"><i class="fas fa-bars"></i></button>
        <h1 class="text-2xl font-bold text-text-dark hidden md:block">@yield('title', 'Dashboard')</h1>
    </div>

    <div class="flex items-center gap-4">
        <div class="relative hidden md:block">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-text-light"></i>
            <input type="text" placeholder="Cari sesuatu..."
                class="bg-background border border-border rounded-full py-2 pl-12 pr-4 w-64 focus:outline-none focus:ring-2 focus:ring-primary transition-all">
        </div>
        <button class="text-text-light hover:text-primary text-xl relative">
            <i class="fas fa-bell"></i>
            <span
                class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
        </button>

        <!-- PERUBAHAN DI SINI: Dropdown Profil Pengguna yang Ditingkatkan -->
        <div class="dropdown">
            <button id="profile-dropdown-toggle" aria-label="User Menu"
                class="flex items-center gap-3 transition-opacity hover:opacity-80">
                <img src="https://placehold.co/40x40/4A90E2/FFFFFF?text=A" alt="User Avatar"
                    class="w-10 h-10 rounded-full">
                <div class="hidden sm:block text-left">
                    <p class="font-semibold text-sm text-text-dark">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-text-light">#</p>
                </div>
                <i
                    class="fas fa-chevron-down text-xs text-text-light hidden sm:block transition-transform duration-200"></i>
            </button>
            <div id="profile-dropdown-menu" class="dropdown-menu">
                <div class="px-4 py-3 border-b border-border">
                    <p class="text-sm font-semibold text-text-dark">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-text-light truncate">{{ Auth::user()->email }}</p>
                </div>
                <ul class="py-2">
                    <li><a href="{{ route('dashboard.profile.edit') }}"
                            class="flex items-center gap-3 px-4 py-2 text-sm text-text hover:bg-primary-light hover:text-primary"><i
                                class="fas fa-user-circle fa-fw w-5"></i> Profil</a></li>
                    {{-- <li><a href="#"
                            class="flex items-center gap-3 px-4 py-2 text-sm text-text hover:bg-primary-light hover:text-primary"><i
                                class="fas fa-cog fa-fw w-5"></i> Pengaturan</a></li> --}}
                </ul>
                <div class="py-2 border-t border-border">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="flex items-center gap-3 px-4 py-2 text-sm text-danger hover:bg-red-50"><i
                                class="fas fa-sign-out-alt fa-fw w-5"></i> Logout</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- AKHIR PERUBAHAN -->
    </div>
</header>
