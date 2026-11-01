@extends('layouts.template')

{{-- Meta tags SEO --}}
@section('title', (isset($category) ? 'Kategori: ' . $category->name : 'Berita & Informasi Terkini') . ' - ' .
    ($settings['school_name'] ?? 'Website Sekolah'))
@section('description', 'Ikuti perkembangan dan kegiatan terbaru dari seluruh komunitas ' . ($settings['school_name'] ??
    'sekolah kami') . '.')

@section('content')

    <main id="main-content">

        {{-- Header Halaman --}}
        <section class="bg-white pt-32 pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
                {{-- Judul berubah secara dinamis jika sedang di halaman kategori --}}
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-blue-900">
                    @if (isset($category))
                        Kategori: {{ $category->name }}
                    @elseif (isset($tag))
                        Postingan dengan Tag: #{{ $tag->name }}
                    @else
                        Berita & Informasi Terkini
                    @endif
                </h1>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Ikuti perkembangan dan kegiatan terbaru dari
                    seluruh komunitas {{ $settings['school_name'] ?? 'sekolah kami' }}.</p>
            </div>
        </section>

        <section class="py-16 sm:py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Filter dan Pencarian --}}
                <div x-data="{ open: false }" class="flex flex-col md:flex-row justify-between items-center gap-6 mb-12"
                    data-aos="fade-up" data-aos-delay="100">

                    {{-- Filter Mobile --}}
                    <div class="relative w-full md:hidden">
                        <button @click="open = !open"
                            class="w-full flex justify-between items-center px-4 py-2 text-sm font-semibold bg-white text-gray-700 rounded-lg shadow-sm">
                            <span>Filter Kategori</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300"
                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                            class="w-full bg-white rounded-lg shadow-xl py-2" style="display: none;">
                            <a href="{{ route('berita.posts.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Semua</a>
                            @foreach ($categories as $cat)
                                <a href="{{ route('berita.posts.category', $cat->slug) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $cat->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Filter Dekstop --}}
                    <div class="hidden md:flex flex-wrap justify-center gap-2">
                        <a href="{{ route('berita.posts.index') }}"
                            class="px-4 py-2 text-sm font-semibold rounded-lg shadow-sm
               {{ request()->routeIs('berita.posts.index') ? 'bg-blue-700 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                            Semua
                        </a>
                        @foreach ($categories as $cat)
                            <a href="{{ route('berita.posts.category', $cat->slug) }}"
                                class="px-4 py-2 text-sm font-semibold rounded-lg shadow-sm
               {{ request()->route('category') && request()->route('category')->slug === $cat->slug
                   ? 'bg-blue-700 text-white'
                   : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>

                    <div class="relative w-full md:w-auto">
                        <form action="{{ route('berita.posts.index') }}" method="GET">
                            <input type="text" name="search" placeholder="Cari artikel..."
                                value="{{ request('search') }}"
                                class="w-full md:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </form>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Artikel Unggulan (Hanya tampil jika tidak di halaman kategori) --}}
                @if ($featuredPost)
                    <article
                        class="mb-16 group block rounded-3xl border border-gray-200 hover:border-blue-400 shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden bg-white focus-within:ring-2 focus-within:ring-blue-300"
                        data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('berita.posts.show', $featuredPost->slug) }}"
                            class="block focus:outline-none focus:ring-0" aria-label="Baca detail berita unggulan">
                            <div class="grid grid-cols-1 lg:grid-cols-2">

                                <!-- Gambar Featured -->
                                <div class="relative overflow-hidden">
                                    <img src="{{ $featuredPost->image_path ? asset('storage/' . $featuredPost->image_path) : 'https://placehold.co/1280x800/1E3A8A/FFFFFF?text=Featured+Post' }}"
                                        alt="{{ $featuredPost->image_alt ?? $featuredPost->title }}"
                                        class="w-full h-64 lg:h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-in-out" />
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent">
                                    </div>
                                </div>

                                <!-- Konten Featured -->
                                <div class="p-8 md:p-10 flex flex-col justify-center bg-white">

                                    <!-- Kategori -->
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                            {{ $featuredPost->category->name }}
                                        </span>
                                    </div>

                                    <!-- Judul -->
                                    <h2
                                        class="mt-4 text-2xl md:text-3xl font-bold text-blue-900 leading-snug group-hover:text-yellow-600 transition-colors duration-300">
                                        {{ $featuredPost->title }}
                                    </h2>

                                    <!-- Meta Info -->
                                    <div class="mt-3 text-sm text-gray-500">
                                        <p>
                                            Oleh <strong class="text-gray-700">{{ $featuredPost->user->name }}</strong>
                                            pada
                                            <time>{{ $featuredPost->published_at->isoFormat('D MMMM YYYY') }}</time>
                                        </p>
                                    </div>

                                    <!-- Deskripsi -->
                                    <p class="mt-4 text-gray-700 leading-relaxed line-clamp-3">
                                        {{ Str::limit(strip_tags($featuredPost->content), 150) }}
                                    </p>

                                    <!-- CTA -->
                                    <div
                                        class="mt-6 inline-flex items-center gap-2 text-blue-700 font-semibold group-hover:text-yellow-600 transition-colors duration-300">
                                        <span>Baca Selengkapnya</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                @endif

                {{-- Grid Artikel Lainnya --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($posts as $post)
                        <article
                            class="bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200 group flex flex-col"
                            data-aos="fade-up" data-aos-delay="300">

                            <!-- Gambar Thumbnail -->
                            <a href="{{ route('berita.posts.show', $post->slug) }}" class="block overflow-hidden">
                                <img src="{{ $post->image_path ? asset('storage/' . $post->image_path) : 'https://placehold.co/600x400/34D399/FFFFFF?text=Prestasi' }}"
                                    alt="{{ $post->image_alt ?? $post->title }}"
                                    class="w-full h-56 object-cover transform group-hover:scale-105 transition-transform duration-500">
                            </a>

                            <!-- Konten Card -->
                            <div class="p-6 flex flex-col flex-grow space-y-4 bg-white">

                                <!-- Tag Kategori -->
                                <span
                                    class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full w-max uppercase tracking-wide">
                                    {{ $post->category->name }}
                                </span>

                                <!-- Judul -->
                                <a href="{{ route('berita.posts.show', $post->slug) }}"
                                    class="transition-colors duration-300 group-hover:text-yellow-500">
                                    <h3 class="text-xl font-bold text-blue-900 leading-snug line-clamp-2">
                                        {{ $post->title }}
                                    </h3>
                                </a>

                                <!-- Info Penulis dan Tanggal -->
                                <div class="text-sm text-gray-500">
                                    Oleh <strong class="text-gray-700">{{ $post->user->name }}</strong> •
                                    <time>{{ $post->published_at->isoFormat('D MMMM YYYY') }}</time>
                                </div>

                                <!-- Deskripsi -->
                                <p class="text-gray-600 text-sm line-clamp-3">
                                    {{ Str::limit(strip_tags($post->content), 100) }}
                                </p>

                                <!-- Link Baca Selengkapnya -->
                                <a href="{{ route('berita.posts.show', $post->slug) }}"
                                    class="mt-auto text-sm font-medium text-blue-700 hover:text-yellow-500 transition-colors duration-300 inline-flex items-center gap-1">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                            </div>
                        </article>
                    @empty
                        <div class="col-span-full text-center py-16">
                            <i class="fas fa-folder-open fa-4x text-gray-300"></i>
                            <p class="mt-4 text-gray-500">
                                @if (request('search'))
                                    Tidak ada artikel yang cocok dengan pencarian "{{ request('search') }}".
                                @elseif (isset($category))
                                    Belum ada artikel dalam kategori ini.
                                @else
                                    Belum ada artikel untuk ditampilkan.
                                @endif
                            </p>
                        </div>
                    @endforelse


                </div>




                {{-- Paginasi --}}
                @if ($posts->hasPages())
                    <nav class="mt-16 flex justify-center" aria-label="Paginasi" data-aos="fade-up">
                        {{ $posts->links() }}
                    </nav>
                @endif
            </div>
        </section>
    </main>

@endsection
