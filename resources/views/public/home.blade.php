@extends('layouts.template')


{{-- Meta tags ini akan otomatis mengisi @yield di layout utama --}}
@section('title', 'Beranda - ' . ($settings['school_name'] ?? 'Website Sekolah'))
@section('description',
    'Selamat datang di situs web resmi ' .
    ($settings['school_name'] ?? 'sekolah kami') .
    '. Temukan
    informasi lengkap mengenai profil, pendaftaran, dan kegiatan terbaru.')
@section('keywords', 'beranda, home, profil sekolah')

@section('content')
    <main id="main-content">
        <!-- 1. HERO SECTION -->
        <section class="relative h-[80vh] md:h-[90vh] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0">
                <img src="img/Gedung-sma-lab-upgris.jpg" alt="Suasana kampus SMA Laboratorium UPGRIS"
                    class="w-full h-full object-cover ken-burns">
                <div class="absolute inset-0 bg-gradient-to-t from-blue-950/75 to-blue-800/50"></div>
            </div>
            <div class="relative z-10 text-center px-4" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-white drop-shadow-xl">
                    {{ $settings['school_name'] ?? 'SMA Laboratorium UPGRIS' }}
                </h1>
                <p class="mt-4 text-lg md:text-xl text-blue-200/95 max-w-3xl mx-auto">
                    Membentuk Insan Cerdas, Kompetitif, dan Berkarakter Pancasila.
                </p>
                <div class="mt-10 flex flex-wrap justify-center gap-4">
                    <a href="{{ $infoPPDB ? route('profil.pages.show', $infoPPDB->slug) : '#' }}"
                        class="inline-flex items-center justify-center bg-yellow-400 text-blue-900 font-semibold py-3 px-8 rounded-xl
                              ring-1 ring-yellow-300/60 shadow-sm hover:shadow-lg
                              transform-gpu transition duration-200 hover:-translate-y-0.5 active:translate-y-0
                              hover:bg-yellow-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-yellow-500 text-lg">
                        Info PPDB 2025
                    </a>
                    <a href="{{ $profilSekolah ? route('profil.pages.show', $profilSekolah->slug) : '#' }}"
                        class="inline-flex items-center justify-center bg-white/20 backdrop-blur-sm border border-white/50 text-white font-semibold py-3 px-8 rounded-xl
                              ring-1 ring-white/40 hover:ring-white/60 shadow-sm hover:shadow-lg
                              transform-gpu transition duration-200 hover:-translate-y-0.5 active:translate-y-0
                              hover:bg-white/30 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-white text-lg">
                        Jelajahi Profil
                    </a>
                </div>
            </div>
        </section>

        <!-- 2. STATISTIK KUNCI -->
        <section class="bg-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    
                    {{-- Tenaga Pendidik --}}
                    <div data-aos="fade-up" data-aos-delay="0"
                        class="p-4 space-y-3 rounded-2xl ring-1 ring-gray-200/70 bg-white
                                transform-gpu transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div
                            class="mx-auto w-16 h-16 flex items-center justify-center bg-blue-100 rounded-full text-blue-600 ring-1 ring-blue-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div x-data="counter({{ $statistics['teacherCount'] }})" x-intersect:enter="start"
                            class="text-5xl font-extrabold text-blue-900">
                            <span x-text="Math.round(current)"></span>
                        </div>
                        <p class="text-gray-600 font-medium">Tenaga Pendidik</p>
                    </div>

                    {{-- Siswa Aktif --}}
                    <div data-aos="fade-up" data-aos-delay="100"
                        class="p-4 space-y-3 rounded-2xl ring-1 ring-gray-200/70 bg-white
                                transform-gpu transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div
                            class="mx-auto w-16 h-16 flex items-center justify-center bg-yellow-100 rounded-full text-yellow-600 ring-1 ring-yellow-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21v-1a6 6 0 00-9-5.197m0 0A11.953 11.953 0 0112 10c4.571 0 8.453 2.892 10.442 7.105M15 21a6 6 0 00-9-5.197">
                                </path>
                            </svg>
                        </div>
                        <div x-data="counter(360)" x-intersect:enter="start"
                            class="text-5xl font-extrabold text-blue-900">
                            <span x-text="Math.round(current)"></span>
                        </div>
                        <p class="text-gray-600 font-medium">Siswa Aktif</p>
                    </div>

                    {{-- Ekstrakurikuler --}}
                    <div data-aos="fade-up" data-aos-delay="200"
                        class="p-4 space-y-3 rounded-2xl ring-1 ring-gray-200/70 bg-white
                                transform-gpu transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div
                            class="mx-auto w-16 h-16 flex items-center justify-center bg-green-100 rounded-full text-green-600 ring-1 ring-green-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z">
                                </path>
                            </svg>
                        </div>
                        <div x-data="counter({{ $statistics['extracurricularCount'] }})" x-intersect:enter="start"
                            class="text-5xl font-extrabold text-blue-900">
                            <span x-text="Math.round(current)"></span>
                        </div>
                        <p class="text-gray-600 font-medium">Ekstrakurikuler</p>
                    </div>

                    {{-- Prestasi --}}
                    <div data-aos="fade-up" data-aos-delay="300"
                        class="p-4 space-y-3 rounded-2xl ring-1 ring-gray-200/70 bg-white
                                transform-gpu transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div
                            class="mx-auto w-16 h-16 flex items-center justify-center bg-red-100 rounded-full text-red-600 ring-1 ring-red-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z"></path>
                            </svg>
                        </div>
                        <div x-data="counter({{ $statistics['achievementCount'] }})" x-intersect:enter="start"
                            class="text-5xl font-extrabold text-blue-900">
                            <span x-text="Math.round(current)"></span>
                        </div>
                        <p class="text-gray-600 font-medium">Prestasi</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- 3. BERITA TERBARU -->
        <section class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <span class="text-yellow-500 font-semibold uppercase tracking-wider">Kabar Sekolah</span>
                    <h2 class="text-4xl font-extrabold text-blue-900 mt-2 break-words tracking-tight">Berita & Informasi
                        Terkini</h2>
                    <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Ikuti perkembangan dan kegiatan terbaru dari
                        komunitas
                        SMA Laboratorium UPGRIS.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($latestPosts as $post)
                        <article data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}"
                            class="bg-white rounded-xl ring-1 ring-gray-200/70 shadow-sm overflow-hidden group
                                   transform-gpu transition duration-300 hover:-translate-y-1 hover:shadow-xl
                                   focus-within:ring-2 focus-within:ring-yellow-500 focus-within:ring-offset-2">
                            <div class="overflow-hidden">
                                <img src="{{ $post->image_path ? asset('storage/' . $post->image_path) : 'https://placehold.co/600x400/E2E8F0/334155?text=Berita' }}"
                                    alt="{{ $post->image_alt ?? $post->title }}"
                                    class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-6">
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-1 rounded-full ring-1 ring-yellow-200">{{ $post->category->name }}</span>
                                <a href="{{ route('berita.posts.show', $post->slug) }}">
                                    <h3
                                        class="text-xl font-bold text-blue-900 mt-4 mb-3 leading-snug tracking-tight group-hover:text-yellow-600 transition-colors duration-300">
                                        {{ $post->title }}</h3>
                                    <span class="sr-only">, baca selengkapnya</span>
                                </a>
                                <p class="text-gray-600 mb-4 text-sm line-clamp-3">
                                    {{ Str::limit(strip_tags($post->content), 120) }}</p>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <p class="text-gray-500">Belum ada berita untuk ditampilkan.</p>
                        </div>
                    @endforelse

                </div>
                <div class="text-center mt-16" data-aos="fade-up">
                    <a href="{{ route('berita.posts.index') }}"
                        class="inline-flex items-center justify-center bg-blue-800 text-white font-semibold py-3 px-8 rounded-xl text-lg
                              ring-1 ring-blue-700/60 shadow-sm hover:shadow-lg transform-gpu transition duration-200
                              hover:-translate-y-0.5 active:translate-y-0 hover:bg-blue-700
                              focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-600">
                        Lihat Semua Berita
                    </a>
                </div>
            </div>
        </section>

        <!-- 4. AGENDA MENDATANG -->
        <section class="bg-gradient-to-br from-blue-900 to-gray-900 text-white py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <span class="text-yellow-400 font-semibold uppercase tracking-wider">Kalender Akademik</span>
                    <h2 class="text-4xl font-extrabold mt-2 break-words tracking-tight">Agenda Sekolah</h2>
                    <p class="mt-4 text-blue-200 max-w-2xl mx-auto">Jangan lewatkan acara dan kegiatan penting kami
                        selanjutnya.</p>
                </div>
                <div class="max-w-3xl mx-auto space-y-4">
                    @forelse ($upcomingEvents as $event)
                        <div data-aos="fade-left" data-aos-delay="{{ $loop->iteration * 100 }}"
                            class="group bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-4 flex items-center space-x-6
                                    focus-within:ring-2 focus-within:ring-yellow-400 focus-within:ring-offset-2 focus-within:ring-offset-blue-900
                                    transform-gpu transition-all duration-300 hover:bg-white/20 hover:scale-[1.02] hover:shadow-lg">
                            <div
                                class="bg-yellow-400 text-blue-900 rounded-lg p-3 text-center w-24 flex-shrink-0 ring-1 ring-yellow-300/70 shadow-sm">
                                <div class="text-4xl font-extrabold">{{ $event->start_date->format('d') }}</div>
                                <div class="text-sm font-bold uppercase">{{ $event->start_date->format('M') }}</div>
                            </div>
                            <div>
                                <h3
                                    class="font-bold text-xl text-white tracking-tight group-hover:text-yellow-300 transition-colors">
                                    {{ $event->title }}</h3>
                                <p class="text-sm text-blue-200 mt-1">{{ Str::limit($event->description, 50) }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-blue-200 py-10">
                            <p>Belum ada agenda mendatang untuk ditampilkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- 5. TESTIMONI ALUMNI -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <span class="text-yellow-500 font-semibold uppercase tracking-wider">Jejak Alumni</span>
                    <h2 class="text-4xl font-extrabold text-blue-900 mt-2 break-words tracking-tight">Kata Mereka Tentang
                        Kami</h2>
                    <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Kesan dan pesan dari para alumni yang telah sukses
                        meniti karir.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    @forelse ($testimonials as $testimonial)
                        <div data-aos="{{ $loop->first ? 'fade-right' : 'fade-left' }}"
                            class="bg-gray-50 p-8 rounded-xl relative border border-gray-200 ring-1 ring-gray-200/70
                                    transform-gpu transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                            <svg class="absolute top-4 left-4 w-16 h-16 text-gray-200 opacity-50" fill="currentColor"
                                viewBox="0 0 32 32">
                                <path
                                    d="M9.33,12.49A4.6,4.6,0,0,0,4.7,17.12a4.52,4.52,0,0,0,4.63,4.62,4.8,4.8,0,0,0,4.54-4.62C13.87,12.49,9.33,12.49,9.33,12.49ZM22.67,12.49A4.6,4.6,0,0,0,18,17.12a4.52,4.52,0,0,0,4.63,4.62,4.8,4.8,0,0,0,4.54-4.62C27.17,12.49,22.67,12.49,22.67,12.49Z">
                                </path>
                            </svg>
                            <blockquote class="relative text-gray-600 text-lg leading-relaxed">
                                "{{ $testimonial->testimonial }}"</blockquote>
                            <div class="mt-6 flex items-center">
                                <img src="{{ $testimonial->image_path ? asset('storage/' . $testimonial->image_path) : 'https://placehold.co/100x100/E2E8F0/334155?text=' . substr($testimonial->name, 0, 1) }}"
                                    alt="{{ $testimonial->image_alt ?? 'Foto ' . $testimonial->name }}"
                                    class="w-14 h-14 rounded-full object-cover shadow-md ring-1 ring-gray-200">
                                <div class="ml-4">
                                    <p class="font-bold text-blue-900">{{ $testimonial->name }}</p>
                                    <p class="text-sm text-gray-500">Alumni {{ $testimonial->graduation_year }} -
                                        {{ $testimonial->current_occupation }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection
