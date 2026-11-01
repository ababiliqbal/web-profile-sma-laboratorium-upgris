@extends('layouts.template')

{{-- Meta tags SEO --}}
@section('title', 'Galeri Kegiatan Sekolah - ' . ($settings['school_name'] ?? 'Website Sekolah'))
@section('description', 'Kumpulan album foto kegiatan sekolah: class meeting, upacara, lomba, hingga pentas seni.')

@section('content')
    <main id="main-content">
        <!-- Hero / Intro -->
        <section class="bg-gradient-to-b from-white to-gray-50 pt-12 sm:pt-16 pb-6 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-blue-900">
                    Galeri Foto Sekolah
                </h1>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                    Jelajahi dokumentasi kegiatan akademik, ekstrakurikuler, hingga perayaan sekolah. Setiap album
                    menyimpan cerita dan prestasi siswa kami.
                </p>
            </div>
        </section>

        <!-- Toolbar  -->
        <section class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form action="{{ route('galeri.galleries.index') }}" method="GET"
                    class="flex flex-col md:flex-row items-stretch md:items-center gap-4">
                    <div class="relative flex-1">
                        <label for="search-album" class="sr-only">Cari album</label>
                        <input id="search-album" type="search" placeholder="Cari album…" name="search"
                            value="{{ request('search') }}"
                            class="w-full rounded-xl border-gray-300 focus:border-yellow-600 focus:ring-yellow-600 py-2.5 pl-10 pr-4"
                            aria-describedby="search-help" />
                        <svg class="w-5 h-5 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 102.546 7.086l3.683 3.685a1 1 0 001.414-1.414l-3.685-3.683A4 4 0 008 4zm-6 4a6 6 0 1110.668 3.735l3.798 3.8a3 3 0 11-4.243 4.242l-3.8-3.798A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                        <p id="search-help" class="sr-only">Ketik nama/deskripsi album untuk mencari.</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <label for="sort" class="text-sm text-gray-600">Urutkan:</label>
                        <select id="sort" name="sort" onchange="this.form.submit()"
                            class="rounded-xl border-gray-300 focus:border-yellow-600 focus:ring-yellow-600">
                            <option value="terbaru" @selected(request('sort', 'terbaru') == 'terbaru')>Terbaru</option>
                            <option value="terlama" @selected(request('sort') == 'terlama')>Terlama</option>
                            <option value="terbanyak" @selected(request('sort') == 'terbanyak')>Terbanyak Foto</option>
                        </select>
                    </div>
                </form>
            </div>
        </section>

        <!-- Grid Album -->
        <section class="pb-12 sm:pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

                    @forelse ($albums as $album)
                        <div
                            class="group transform-gpu transition duration-300 ease-out hover:-translate-y-2 focus-within:-translate-y-2">
                            <article
                                class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden hover:shadow-lg hover:-translate-y-0.5 transition"
                                data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                                <a href="{{ route('galeri.galleries.show', $album) }}" class="block group"
                                    aria-label="Lihat album: {{ $album->name }}">
                                    <figure class="aspect-[16/9] overflow-hidden">
                                        @php $cover = $album->photos->first(); @endphp
                                        <img src="{{ $cover ? asset('storage/' . $cover->image_path) : 'https://placehold.co/1200x675/E2E8F0/334155?text=Galeri' }}"
                                            alt="Sampul album {{ $album->name }}"
                                            class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                            loading="lazy" />
                                    </figure>
                                    <div class="p-5">
                                        <div class="flex items-center gap-2 mb-3">
                                            <span
                                                class="inline-flex items-center rounded-full bg-yellow-600 text-white text-xs font-semibold px-2.5 py-1">
                                                {{ $album->photos->count() }} Foto
                                            </span>
                                            <time class="text-xs text-gray-500"
                                                datetime="{{ $album->created_at->toW3cString() }}">{{ $album->created_at->isoFormat('D MMM YYYY') }}</time>
                                        </div>
                                        <h2 class="text-lg font-bold text-blue-900">
                                            {{ $album->name }}
                                        </h2>
                                        <p class="mt-2 text-sm text-gray-600 line-clamp-3">
                                            {{ $album->description }}
                                        </p>
                                        <div
                                            class="mt-4 flex items-center gap-2 text-sm font-medium text-blue-900 group-hover:text-yellow-600">
                                            <span>Lihat album</span>
                                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M10.293 15.707a1 1 0 010-1.414L12.586 12H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-16 text-gray-500">
                            <i class="fas fa-images fa-4x"></i>
                            <p class="mt-4 font-medium">
                                @if (request('search'))
                                    Album dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                                @else
                                    Belum ada album untuk ditampilkan.
                                @endif
                            </p>
                            @if (request('search'))
                                <a href="{{ route('galeri.galleries.index') }}"
                                    class="mt-2 text-sm text-primary hover:underline">Lihat semua album</a>
                            @endif
                        </div>
                    @endforelse
                </div>

                {{-- Paginasi --}}
                @if ($albums->hasPages())
                    <nav class="mt-16 flex justify-center" aria-label="Paginasi">
                        {{ $albums->links() }}
                    </nav>
                @endif
            </div>
        </section>
    </main>
@endsection
