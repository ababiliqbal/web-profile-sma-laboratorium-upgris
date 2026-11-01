{{-- Navbar --}}
<header class="bg-white/80 backdrop-blur-lg shadow-sm sticky top-0 z-50">
    <nav x-data="{ open: false }" class="border-b border-gray-200" aria-label="Navigasi Utama">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Bagian Kiri: Logo dan Nama Sekolah -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <img class="h-12 w-auto"
                            src="{{ isset($settings['school_logo']) ? asset('storage/' . $settings['school_logo']) : 'https://placehold.co/128x128/1E3A8A/FFFFFF?text=LOGO' }}"
                            alt="Logo {{ $settings['school_name'] ?? 'Sekolah' }}">
                        <div class="hidden md:flex flex-col leading-tight font-bold">
                            <span class="text-sm md:text-base text-gray-700">SMA Laboratorium</span>
                            <span
                                class="text-xl md:text-2xl lg:text-3xl bg-gradient-to-r from-blue-900 via-blue-600 to-blue-400 text-transparent bg-clip-text">
                                UPGRIS
                            </span>
                        </div>

                    </a>
                </div>

                <!-- Bagian Tengah: Menu Navigasi (Desktop) -->
                <div class="hidden lg:flex lg:items-center lg:space-x-4 2xl:space-x-8">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ request()->routeIs('home') ? 'active text-blue-900' : 'text-gray-600 hover:text-blue-900' }} font-medium lg:text-sm 2xl:text-base"
                        aria-current="page">Beranda</a>

                    <!-- Dropdown: Profil Sekolah -->
                    <div class="relative" x-data="{ dropdownOpen: false }" @mouseenter="dropdownOpen = true"
                        @mouseleave="dropdownOpen = false" @keydown.escape.prevent="dropdownOpen = false">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false"
                            aria-controls="dropdown-profil-desktop" :aria-expanded="dropdownOpen"
                            class="nav-link inline-flex items-center {{ request()->is('profil/visi-misi') ||
                            request()->is('profil/program-kerja-sekolah') ||
                            request()->is('profil/akreditasi-sekolah')
                                ? 'active text-blue-900'
                                : 'text-gray-600 hover:text-blue-900' }} font-medium lg:text-sm 2xl:text-base">
                            <span>Profil Sekolah</span>
                            <svg class="w-4 h-4 ml-1.5 transform transition-transform duration-300"
                                :class="{ 'rotate-180': dropdownOpen }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="dropdown-profil-desktop" x-show="dropdownOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute z-10 mt-4 min-w-full w-max bg-white rounded-lg shadow-xl py-2">
                            @if (isset($navPages))
                                @foreach ($navPages->take(3) as $page)
                                    <a href="{{ route('profil.pages.show', $page->slug) }}" x-show="dropdownOpen"
                                        x-transition:enter="transition ease-out duration-200 delay-[150ms]"
                                        x-transition:enter-start="opacity-0 translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800">{{ $page->title }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Dropdown: Akademik -->
                    <div class="relative" x-data="{ dropdownOpen: false }" @mouseenter="dropdownOpen = true"
                        @mouseleave="dropdownOpen = false" @keydown.escape.prevent="dropdownOpen = false">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false"
                            aria-controls="dropdown-akademik-desktop" :aria-expanded="dropdownOpen"
                            class="nav-link inline-flex items-center {{ request()->routeIs('akademik.*') ||
                            request()->is('profil/kurikulum') ||
                            request()->is('profil/kegiatan-intrakurikuler') ||
                            request()->is('profil/kegiatan-kokurikuler')
                                ? 'active text-blue-900'
                                : 'text-gray-600 hover:text-blue-900' }} font-medium lg:text-sm 2xl:text-base">
                            <span>Akademik</span>
                            <svg class="w-4 h-4 ml-1.5 transform transition-transform duration-300"
                                :class="{ 'rotate-180': dropdownOpen }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="dropdown-akademik-desktop" x-show="dropdownOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute z-10 mt-4 min-w-full w-max bg-white rounded-lg shadow-xl py-2">
                            @if (isset($navPages))
                                @php $kurikulumPageFound = false; @endphp
                                @foreach ($navPages as $page)
                                    @if ($page->title === 'Kurikulum')
                                        @php $kurikulumPageFound = true; @endphp

                                        <div x-data="{ subMenuOpen: false }" @mouseenter="subMenuOpen = true"
                                            @mouseleave="subMenuOpen = false" class="relative" x-show="dropdownOpen"
                                            x-transition:enter="transition ease-out duration-200 delay-[150ms]"
                                            x-transition:enter-start="opacity-0 translate-y-1"
                                            x-transition:enter-end="opacity-100 translate-y-0">

                                            <a href="{{ route('profil.pages.show', $page->slug) }}"
                                                class="w-full flex items-center justify-between px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800"
                                                :class="{ 'bg-blue-50 text-blue-800': subMenuOpen }">
                                                <span>{{ $page->title }}</span>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>

                                            <div x-show="subMenuOpen"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 translate-x-2"
                                                x-transition:enter-end="opacity-100 translate-x-0"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100 translate-x-0"
                                                x-transition:leave-end="opacity-0 translate-x-2"
                                                class="absolute z-10 top-0 left-full ml-1 w-max min-w-full bg-white rounded-lg shadow-xl py-2"
                                                style="display: none;">

                                                <a href="{{ route('profil.pages.show', 'kegiatan-intrakurikuler') }}"
                                                    class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800">Kegiatan
                                                    Intrakurikuler</a>
                                                <a href="{{ route('profil.pages.show', 'kegiatan-kokurikuler') }}"
                                                    class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800">Kegiatan
                                                    Kokurikuler</a>
                                                <a href="{{ route('akademik.academic-events.index') }}"
                                                    class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800">Kalender
                                                    Akademik</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            <a href="{{ route('akademik.achievements.index') }}" x-show="dropdownOpen"
                                x-transition:enter="transition ease-out duration-200 delay-[100ms]"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800">Prestasi</a>
                        </div>
                    </div>

                    <!-- Dropdown: Kesiswaan -->
                    <div class="relative" x-data="{ dropdownOpen: false }" @mouseenter="dropdownOpen = true"
                        @mouseleave="dropdownOpen = false" @keydown.escape.prevent="dropdownOpen = false">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false"
                            aria-controls="dropdown-kesiswaan-desktop" :aria-expanded="dropdownOpen"
                            class="nav-link inline-flex items-center {{ request()->routeIs('kesiswaan.*') ? 'active text-blue-900' : 'text-gray-600 hover:text-blue-900' }}  font-medium lg:text-sm 2xl:text-base">
                            <span>Kesiswaan</span>
                            <svg class="w-4 h-4 ml-1.5 transform transition-transform duration-300"
                                :class="{ 'rotate-180': dropdownOpen }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="dropdown-kesiswaan-desktop" x-show="dropdownOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute z-10 mt-4 min-w-full w-max bg-white rounded-lg shadow-xl py-2">
                            <a href="{{ route('kesiswaan.student-organizations.index') }}" x-show="dropdownOpen"
                                x-transition:enter="transition ease-out duration-200 delay-[50ms]"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800">Organisasi</a>
                            <a href="{{ route('kesiswaan.extracurriculars.index') }}" x-show="dropdownOpen"
                                x-transition:enter="transition ease-out duration-200 delay-[50ms]"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800">Ekstrakurikuler</a>
                        </div>
                    </div>

                    <!-- Dropdown: Sarpras -->
                    <div class="relative" x-data="{ dropdownOpen: false }" @mouseenter="dropdownOpen = true"
                        @mouseleave="dropdownOpen = false" @keydown.escape.prevent="dropdownOpen = false">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false"
                            aria-controls="dropdown-sarpras-desktop" :aria-expanded="dropdownOpen"
                            class="nav-link inline-flex items-center {{ request()->routeIs('sarpras.*') ? 'active text-blue-900' : 'text-gray-600 hover:text-blue-900' }}  font-medium lg:text-sm 2xl:text-base">
                            <span>Sarana & Prasarana</span>
                            <svg class="w-4 h-4 ml-1.5 transform transition-transform duration-300"
                                :class="{ 'rotate-180': dropdownOpen }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="dropdown-sarpras-desktop" x-show="dropdownOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute z-10 mt-4 min-w-full w-max bg-white rounded-lg shadow-xl py-2">
                            <a href="{{ route('sarpras.facilities.index') }}" x-show="dropdownOpen"
                                x-transition:enter="transition ease-out duration-200 delay-[50ms]"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-800">Fasilitas
                                Sekolah</a>
                        </div>
                    </div>

                    <a href="{{ route('berita.posts.index') }}"
                        class="nav-link {{ request()->routeIs('berita.*') ? 'active text-blue-900' : 'text-gray-600 hover:text-blue-900' }} font-medium lg:text-sm 2xl:text-base">Berita</a>
                </div>

                <!-- Bagian Kanan: Tombol CTA (Desktop) -->
                <div class="hidden lg:flex lg:items-center">
                    <button @click="searchOpen = true"
                        class="p-2 rounded-full text-gray-500 hover:text-blue-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-300"
                        aria-label="Buka pencarian">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Tombol Hamburger (Mobile & Tablet) -->
                <div class="lg:hidden flex items-center">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <div class="w-6 h-6 relative">
                            <span class="sr-only">Buka menu utama</span>
                            <span aria-hidden="true"
                                class="absolute block h-0.5 w-6 bg-current transform transition duration-300 ease-in-out"
                                :class="{ 'rotate-45': open, '-translate-y-1.5': !open }"></span>
                            <span aria-hidden="true"
                                class="absolute block h-0.5 w-6 bg-current transform transition duration-300 ease-in-out"
                                :class="{ 'opacity-0': open }"></span>
                            <span aria-hidden="true"
                                class="absolute block h-0.5 w-6 bg-current transform transition duration-300 ease-in-out"
                                :class="{ '-rotate-45': open, 'translate-y-1.5': !open }"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu Mobile (Lengkap) -->
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95" class="lg:hidden origin-top-right" id="mobile-menu"
            role="navigation" aria-label="Navigasi Mobile">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" @click="open = false"
                    class="block px-3 py-2 rounded-md text-base font-medium text-blue-700 bg-blue-50">Beranda</a>
                <a href="#" @click.prevent="searchOpen = true; open = false"
                    class="flex items-center w-full px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                    <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span>Pencarian</span>
                </a>

                {{-- Dropdown Mobile Profil --}}
                <div x-data="{ dropdownMobileOpen: false }">
                    <button @click="dropdownMobileOpen = !dropdownMobileOpen" aria-controls="dropdown-profil-mobile"
                        :aria-expanded="dropdownMobileOpen"
                        class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                        :class="{ 'bg-gray-100': dropdownMobileOpen }">
                        <span>Profil Sekolah</span>
                        <svg class="w-5 h-5 transform transition-transform duration-300"
                            :class="{ 'rotate-180': dropdownMobileOpen }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="dropdown-profil-mobile" x-show="dropdownMobileOpen"
                        class="pl-4 mt-1 space-y-1 overflow-hidden"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2">
                        @if (isset($navPages))
                            @foreach ($navPages->take(3) as $page)
                                <a href="{{ route('profil.pages.show', $page->slug) }}" @click="open = false"
                                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">{{ $page->title }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- Dropdown Mobile Akademik --}}
                <div x-data="{ dropdownMobileOpen: false }">
                    <button @click="dropdownMobileOpen = !dropdownMobileOpen" aria-controls="dropdown-akademik-mobile"
                        :aria-expanded="dropdownMobileOpen"
                        class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                        :class="{ 'bg-gray-100': dropdownMobileOpen }">
                        <span>Akademik</span>
                        <svg class="w-5 h-5 transform transition-transform duration-300"
                            :class="{ 'rotate-180': dropdownMobileOpen }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="dropdown-akademik-mobile" x-show="dropdownMobileOpen"
                        class="pl-4 mt-1 space-y-1 overflow-hidden"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2">
                        @if (isset($navPages))
                            @php $kurikulumPageFoundMobile = false; @endphp
                            @foreach ($navPages as $page)
                                @if ($page->title === 'Kurikulum')
                                    @php $kurikulumPageFoundMobile = true; @endphp

                                    <div x-data="{ subDropdownOpen: false }">
                                        {{-- Wrapper untuk Link + Tombol Pemicu --}}
                                        <div class="flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50"
                                            :class="{ 'bg-gray-100': subDropdownOpen }">

                                            {{-- Bagian Link (Teks) --}}
                                            <a href="{{ route('profil.pages.show', $page->slug) }}"
                                                @click="open = false" class="flex-grow hover:text-gray-900">
                                                {{ $page->title }}
                                            </a>

                                            {{-- Bagian Tombol Pemicu (Panah) --}}
                                            <button @click="subDropdownOpen = !subDropdownOpen"
                                                aria-controls="dropdown-kurikulum-mobile"
                                                :aria-expanded="subDropdownOpen"
                                                class="pl-3 pr-1 text-gray-600 hover:text-gray-900 rounded-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <span class="sr-only">Buka sub-menu Kurikulum</span>
                                                <svg class="w-5 h-5 transform transition-transform duration-300"
                                                    :class="{ 'rotate-180': subDropdownOpen }" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        {{-- Panel Sub-menu 'Kurikulum' --}}
                                        <div id="dropdown-kurikulum-mobile" x-show="subDropdownOpen"
                                            class="pl-4 mt-1 space-y-1 overflow-hidden"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 -translate-y-2"
                                            x-transition:enter-end="opacity-100 translate-y-0"
                                            x-transition:leave="transition ease-in duration-200"
                                            x-transition:leave-start="opacity-100 translate-y-0"
                                            x-transition:leave-end="opacity-0 -translate-y-2">

                                            <a href="{{ route('profil.pages.show', 'kegiatan-intrakurikuler') }}"
                                                @click="open = false"
                                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">Kegiatan
                                                Intrakurikuler</a>
                                            <a href="{{ route('profil.pages.show', 'kegiatan-kokurikuler') }}"
                                                @click="open = false"
                                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">Kegiatan
                                                Kokurikuler</a>
                                            <a href="{{ route('akademik.academic-events.index') }}"
                                                @click="open = false"
                                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">Kalender
                                                Akademik</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        <a href="{{ route('akademik.achievements.index') }}" @click="open = false"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">Prestasi</a>
                    </div>
                </div>

                {{-- Dropdown Mobile Kesiswaan --}}
                <div x-data="{ dropdownMobileOpen: false }">
                    <button @click="dropdownMobileOpen = !dropdownMobileOpen"
                        aria-controls="dropdown-kesiswaan-mobile" :aria-expanded="dropdownMobileOpen"
                        class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                        :class="{ 'bg-gray-100': dropdownMobileOpen }">
                        <span>Kesiswaan</span>
                        <svg class="w-5 h-5 transform transition-transform duration-300"
                            :class="{ 'rotate-180': dropdownMobileOpen }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="dropdown-kesiswaan-mobile" x-show="dropdownMobileOpen"
                        class="pl-4 mt-1 space-y-1 overflow-hidden"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2">
                        <a href="{{ route('kesiswaan.student-organizations.index') }}" @click="open = false"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">Organisasi</a>
                        <a href="{{ route('kesiswaan.extracurriculars.index') }}" @click="open = false"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">Ekstrakurikuler</a>
                    </div>
                </div>

                {{-- Dropdown Mobile Sarpras --}}
                <div x-data="{ dropdownMobileOpen: false }">
                    <button @click="dropdownMobileOpen = !dropdownMobileOpen" aria-controls="dropdown-sarpras-mobile"
                        :aria-expanded="dropdownMobileOpen"
                        class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                        :class="{ 'bg-gray-100': dropdownMobileOpen }">
                        <span>Sarana & Prasarana</span>
                        <svg class="w-5 h-5 transform transition-transform duration-300"
                            :class="{ 'rotate-180': dropdownMobileOpen }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="dropdown-sarpras-mobile" x-show="dropdownMobileOpen"
                        class="pl-4 mt-1 space-y-1 overflow-hidden"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2">
                        <a href="{{ route('sarpras.facilities.index') }}" @click="open = false"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">Fasilitas
                            Sekolah</a>
                    </div>
                </div>

                <a href="{{ route('berita.posts.index') }}" @click="open = false"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Berita</a>
            </div>
            <div class="px-5 py-4"><a
                    href="{{ route('profil.pages.show', 'informasi-penerimaan-peserta-didik-baru') }}"
                    @click="open = false"
                    class="block text-center w-full bg-yellow-400 text-blue-900 font-bold py-2.5 px-4 rounded-lg hover:bg-yellow-500 transition duration-300">Info
                    PPDB</a></div>
        </div>
    </nav>
</header>

{{-- Tombol Back to Top --}}
<div x-show="searchOpen" @keydown.escape.window="searchOpen = false"
    class="fixed inset-0 z-50 flex items-start justify-center pt-16 sm:pt-24" role="dialog" aria-modal="true"
    aria-labelledby="search-title" style="display: none;">

    <div x-show="searchOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" @click="searchOpen = false"></div>

    <div x-show="searchOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="relative w-full max-w-lg mx-4" @click.away="searchOpen = false">
        <h2 id="search-title" class="sr-only">Pencarian</h2>
        <form action="{{ route('search.index') }}" method="GET" class="relative">
            <input type="search" name="q" id="search-input" x-ref="searchInput"
                placeholder="Ketikkan kata kunci..."
                class="w-full pl-6 pr-14 py-4 text-lg text-gray-800 bg-white border border-gray-300 rounded-lg shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit"
                class="absolute top-0 right-0 h-full px-5 text-gray-500 hover:text-blue-700 transition-colors"
                aria-label="Cari">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </form>
    </div>
</div>
