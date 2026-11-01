@extends('layouts.template') {{-- Pastikan nama layout Anda benar --}}

{{-- Meta tags SEO --}}
@section('title', 'Pusat Unduhan Berkas - ' . ($settings['school_name'] ?? 'Website Sekolah'))
@section('description',
    'Unduh berbagai berkas penting seperti formulir, brosur, panduan, dan dokumen lainnya yang
    disediakan oleh ' .
    ($settings['school_name'] ?? 'sekolah kami') .
    '.')

@section('content')
    <main id="main-content">
        <!-- Hero -->
        <section class="bg-gradient-to-b from-white to-blue-50/40 pt-28 pb-10 border-b border-gray-100/70">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-blue-900">
                    Pusat Unduhan Berkas
                </h1>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                    Temukan dan unduh berbagai dokumen penting yang Anda butuhkan, mulai dari formulir pendaftaran hingga
                    panduan akademik.
                </p>
            </div>
        </section>

        <!-- Sticky Search -->
        <section class="py-6 sticky top-[80px] bg-gray-50/80 backdrop-blur-lg z-40 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form action="{{ route('documents.index') }}" method="GET"
                    class="flex items-center gap-3 md:gap-4 bg-white/70 rounded-2xl ring-1 ring-gray-200/70 p-2.5 md:p-3 shadow-sm hover:shadow-md transition">
                    <div class="relative flex-1 group">
                        <label for="search-document" class="sr-only">Cari berkas</label>
                        <input id="search-document" type="search" name="search"
                            placeholder="Ketik nama berkas (mis. 'Brosur', 'Formulir')..." value="{{ request('search') }}"
                            class="w-full rounded-2xl border-transparent ring-1 ring-gray-300 focus:ring-2 focus:ring-yellow-600 focus:border-transparent py-2.5 pl-12 pr-4 bg-white/90 placeholder:text-gray-400 shadow-inner transition" />
                        <i
                            class="fas fa-search w-5 h-5 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2 transition group-focus-within:text-yellow-700"></i>
                    </div>
                    <button type="submit"
                        class="btn btn-primary py-2.5 rounded-xl px-5 shadow-sm hover:shadow-md transform-gpu transition hover:-translate-y-0.5 active:translate-y-0">
                        Cari
                    </button>
                </form>
            </div>
        </section>

        <!-- Grid -->
        <section class="py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($documents as $document)
                        <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                            <div
                                class="group bg-white rounded-2xl ring-1 ring-gray-200/70 p-5 h-full flex flex-col shadow-sm transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:ring-blue-300/40">
                                <div class="flex-grow">
                                    <div class="flex items-start gap-4">
                                        {{-- Ikon berdasarkan tipe file (contoh sederhana) --}}
                                        @php
                                            $icon = 'fa-file-alt'; // default
                                            if (Str::contains($document->mime_type, 'pdf')) {
                                                $icon = 'fa-file-pdf';
                                            }
                                            if (Str::contains($document->mime_type, ['word', 'doc'])) {
                                                $icon = 'fa-file-word';
                                            }
                                            if (Str::contains($document->mime_type, ['excel', 'xls'])) {
                                                $icon = 'fa-file-excel';
                                            }
                                        @endphp
                                        <i
                                            class="fas {{ $icon }} text-2xl text-primary mt-0.5 w-12 h-12 flex items-center justify-center rounded-xl bg-blue-50 ring-1 ring-blue-100 shrink-0"></i>
                                        <div>
                                            <h2 class="font-semibold text-blue-900 tracking-tight line-clamp-2">
                                                {{ $document->title }}
                                            </h2>
                                            <p class="text-[11px] md:text-xs text-gray-500/90 mt-1">
                                                Ukuran: {{ number_format($document->file_size / 1024, 1) }} KB • Diunduh:
                                                {{ $document->downloads }} kali
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <a href="{{ route('documents.download', $document) }}"
                                        class="btn btn-primary w-full text-sm py-2.5 rounded-xl px-5 shadow-sm hover:shadow-md transform-gpu transition hover:-translate-y-0.5 active:translate-y-0">
                                        <span>Unduh Berkas</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-16 text-gray-500">
                            <i class="fas fa-folder-open fa-4x text-gray-300"></i>
                            <p class="mt-4 font-medium">
                                @if (request('search'))
                                    Berkas dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                                @else
                                    Belum ada berkas untuk ditampilkan.
                                @endif
                            </p>
                            @if (request('search'))
                                <a href="{{ route('documents.index') }}"
                                    class="mt-2 inline-block text-sm text-primary hover:underline underline-offset-4">
                                    Lihat semua berkas
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>

                {{-- Paginasi --}}
                @if ($documents->hasPages())
                    <nav class="mt-12 sm:mt-16 flex justify-center" aria-label="Paginasi">
                        {{ $documents->links() }}
                    </nav>
                @endif
            </div>
        </section>
    </main>
@endsection
