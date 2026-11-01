@extends('layouts.template')

{{-- Meta tags SEO dinamis untuk setiap album --}}
@section('title', 'Galeri: ' . $album->name . ' - ' . ($settings['school_name'] ?? 'Website Sekolah'))
@section('description', $album->description ?? 'Kumpulan foto dari album ' . $album->name)
@section('og_image', $album->photos->first() ? asset('storage/' . $album->photos->first()->image_path) : null)

@section('content')
    <main id="main-content" x-data="lightbox()" x-init="init()">
        <section class="pt-10 sm:pt-12 pb-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Breadcrumb -->
                <nav class="flex justify-center mb-6 text-sm text-gray-500 overflow-x-hidden" aria-label="Breadcrumb">
                    <ol class="flex flex-wrap items-center justify-center gap-1 md:gap-3 max-w-full">
                        <!-- Crumb 1 -->
                        <li>
                            <div class="flex items-center">
                                <a href="/"
                                    class="text-blue-600 hover:text-yellow-500 transition-colors whitespace-nowrap">Beranda</a>
                                <svg class="shrink-0 w-4 h-4 mx-1.5 md:mx-2 text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </li>

                        <!-- Crumb 2 -->
                        <li>
                            <div class="flex items-center">
                                <a href="{{ route('galeri.galleries.index') }}"
                                    class="text-blue-600 hover:text-yellow-500 transition-colors whitespace-nowrap">Galeri</a>
                                <svg class="shrink-0 w-4 h-4 mx-1.5 md:mx-2 text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </li>

                        <!-- Crumb terakhir (wrap 2 baris di HP, ellipsis 1 baris di ≥sm) -->
                        <li class="min-w-0" aria-current="page">
                            <span
                                class="block max-w-[90vw] sm:max-w-[65vw] md:max-w-none text-gray-700 font-medium
                           line-clamp-2 sm:line-clamp-1"
                                title="Kegiatan Class Meeting 2025">
                                {{ $album->name }}
                            </span>
                        </li>
                    </ol>
                </nav>


                <!-- Header Album -->
                <header class="text-center max-w-3xl mx-auto">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-blue-900">
                        {{ $album->name }}
                    </h1>
                    <p class="mt-4 text-gray-600">
                        {{ $album->description }}
                    </p>
                    <div class="mt-3 inline-flex items-center gap-3 text-sm text-gray-500">
                        <span
                            class="inline-flex items-center rounded-full bg-yellow-600 text-white px-3 py-1 font-semibold">{{ $album->photos->count() }}
                            Foto</span>
                        <time datetime="2025-06-15">Dipublikasikan: {{ $album->created_at->isoFormat('D MMM YYYY') }}</time>
                    </div>
                </header>
            </div>
        </section>

        <!-- Grid Foto -->
        <section class="pb-12 sm:pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

                    @forelse ($album->photos as $photo)
                        <div
                            class="group transform-gpu transition duration-300 ease-out hover:-translate-y-2 focus-within:-translate-y-2">
                            <article
                                class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden transition-shadow duration-300 group-hover:shadow-xl focus-within:shadow-xl"
                                data-aos="zoom-in" data-aos-delay="50">
                                <a href="#"
                                    class="block focus:outline-none focus:ring-2 focus:ring-yellow-600 focus:ring-offset-2 rounded-2xl"
                                    data-photo data-src="{{ asset('storage/' . $photo->image_path) }}"
                                    data-title="{{ $photo->title ?? 'Tanpa Judul' }}"
                                    data-desc="{{ $photo->description ?? '' }}"
                                    data-alt="{{ $photo->image_alt ?? 'Foto dari album ' . $album->name }}"
                                    @click.prevent="openAt({{ $loop->index }})">
                                    <figure class="aspect-[4/3] overflow-hidden">
                                        <img src="{{ asset('storage/' . $photo->image_path) }}"
                                            alt="{{ $photo->image_alt ?? 'Foto dari album ' . $album->name }}"
                                            width="800" height="600" loading="lazy" decoding="async"
                                            class="h-full w-full object-cover transition duration-300 group-hover:scale-105" />
                                    </figure>
                                    <div class="p-4">
                                        <h2 class="text-base font-semibold text-blue-900">
                                            {{ $photo->title ?? 'Tanpa Judul' }}</h2>
                                        <p class="mt-1 text-sm text-gray-600 line-clamp-2">
                                            {{ $photo->descripton }}
                                        </p>
                                    </div>
                                </a>
                            </article>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-16 text-gray-500">
                            <i class="fas fa-camera-retro fa-4x"></i>
                            <p class="mt-4 font-medium">Belum ada foto di dalam album ini.</p>
                        </div>
                    @endforelse
                </div>
                <nav class="mt-10 flex justify-center"> {{ $album->photos()->paginate(12)->links() }} </nav>
            </div>
        </section>

        <!-- Lightbox Modal (Alpine) -->
        <div x-show="open" x-transition.opacity x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/70" @click="close()" aria-hidden="true"></div>

            <!-- Dialog -->
            <div role="dialog" aria-modal="true" aria-labelledby="lb-title" aria-describedby="lb-desc"
                class="relative bg-white rounded-2xl shadow-2xl max-w-5xl w-full overflow-hidden"
                @keydown.window.escape="close()" @keydown.window.arrow-right.prevent="next()"
                @keydown.window.arrow-left.prevent="prev()" x-ref="modal" tabindex="0">

                <!-- Header -->
                <div class="flex items-center justify-between px-4 sm:px-5 py-3 bg-gray-50 border-b border-gray-200">
                    <h3 id="lb-title" class="relative text-base sm:text-lg font-bold tracking-tight text-blue-900">
                        <span class="absolute -bottom-1 left-0 h-0.5 w-12 rounded-full bg-yellow-600"></span>
                        <span x-text="current.title || 'Foto'"></span>
                    </h3>
                    <button type="button"
                        class="rounded-full p-2 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-yellow-600"
                        @click="close()" aria-label="Tutup">
                        <!-- Heroicon: X Mark (solid 20) -->
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293A1 1 0 014.293 14.293L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>


                <!-- Media (relative untuk tombol samping) -->
                <div class="relative bg-black">
                    <img :src="current.src" :alt="current.alt || current.title"
                        class="w-full h-auto max-h-[70vh] object-contain" />

                    <!-- Rail kiri (Prev) -->
                    <div class="absolute inset-y-0 left-0 w-16 flex items-center justify-start z-10 pointer-events-auto">
                        <button type="button"
                            class="ml-2 h-12 w-12 rounded-full bg-white/90 text-blue-900 shadow-md ring-1 ring-black/5
                           transition-transform duration-200 ease-out
                           motion-safe:hover:-translate-x-1
                           focus:outline-none focus:ring-2 focus:ring-yellow-600"
                            @click="prev()" aria-label="Sebelumnya">
                            <!-- Heroicon: Chevron Left (solid 20) -->
                            <svg class="mx-auto h-6 w-6" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.293 15.707a1 1 0 010-1.414L9.414 11l2.879-3.293a1 1 0 10-1.586-1.414l-4 4a1 1 0 000 1.414l4 4a1 1 0 001.586-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <!-- Rail kanan (Next) -->
                    <div class="absolute inset-y-0 right-0 w-16 flex items-center justify-end z-10 pointer-events-auto">
                        <button type="button"
                            class="mr-2 h-12 w-12 rounded-full bg-white/90 text-blue-900 shadow-md ring-1 ring-black/5
                           transition-transform duration-200 ease-out
                           motion-safe:hover:translate-x-1
                           focus:outline-none focus:ring-2 focus:ring-yellow-600"
                            @click="next()" aria-label="Selanjutnya">
                            <!-- Heroicon: Chevron Right (solid 20) -->
                            <svg class="mx-auto h-6 w-6" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Caption -->
                <div class="px-4 sm:px-5 py-4">
                    <div class="h-1 w-14 bg-yellow-600 rounded-full mb-3"></div>
                    <p id="lb-desc" class="text-sm leading-relaxed text-gray-700" x-text="current.desc || ''"></p>
                </div>

            </div>
        </div>
    </main>
    <script>
        function lightbox() {
            return {
                open: false,
                index: 0,
                items: [],
                current: {
                    src: '',
                    title: '',
                    desc: '',
                    alt: ''
                },

                init() {
                    // Ambil semua elemen yang diberi atribut data-photo
                    this.items = Array.from(document.querySelectorAll('[data-photo]')).map((el) => ({
                        src: el.dataset.src,
                        title: el.dataset.title,
                        desc: el.dataset.desc,
                        alt: el.dataset.alt
                    }));
                },

                openAt(i) {
                    if (!this.items.length) return;
                    this.index = i;
                    this.current = this.items[i];
                    this.open = true;
                    this.$nextTick(() => this.$refs.modal && this.$refs.modal.focus());
                    // Prefetch gambar berikutnya (optimisasi kecil)
                    const nextIndex = (i + 1) % this.items.length;
                    const prefetch = new Image();
                    prefetch.src = this.items[nextIndex].src;
                },

                close() {
                    this.open = false;
                },

                next() {
                    if (!this.items.length) return;
                    this.index = (this.index + 1) % this.items.length;
                    this.current = this.items[this.index];
                },

                prev() {
                    if (!this.items.length) return;
                    this.index = (this.index - 1 + this.items.length) % this.items.length;
                    this.current = this.items[this.index];
                }
            }
        }
    </script>
@endsection
