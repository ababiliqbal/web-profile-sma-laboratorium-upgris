@extends('layouts.template')

@section('title', 'Hasil Pencarian untuk "' . e($query) . '"')
@section('description', 'Menampilkan hasil pencarian untuk kata kunci "' . e($query) . '" di website ' .
    ($settings['school_name'] ?? 'sekolah kami') . '.')

@section('content')
    <main id="main-content">
        <!-- Header Halaman -->
        <section class="bg-white pt-28 pb-10 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
                <p class="text-yellow-600 font-semibold">Hasil Pencarian</p>
                <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold tracking-tight text-blue-900">
                    Menampilkan {{ $totalResults }} hasil untuk "<span class="break-all">{{ e($query) }}</span>"
                </h1>
            </div>
        </section>

        <!-- Konten Hasil Pencarian dengan Tab -->
        <section class="py-12 sm:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ tab: 'berita' }">

                <!-- Navigasi Tab -->
                <div class="border-b border-gray-200 mb-8" data-aos="fade-up" data-aos-delay="100">
                    <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                        <button @click="tab = 'berita'"
                            :class="{ 'border-blue-700 text-blue-800': tab === 'berita', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'berita' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Berita & Artikel <span
                                class="bg-gray-200 text-gray-600 rounded-full px-2 py-0.5 ml-1">{{ $posts->total() }}</span>
                        </button>
                        <button @click="tab = 'halaman'"
                            :class="{ 'border-blue-700 text-blue-800': tab === 'halaman', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'halaman' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Halaman <span
                                class="bg-gray-200 text-gray-600 rounded-full px-2 py-0.5 ml-1">{{ $pages->total() }}</span>
                        </button>
                    </nav>
                </div>

                <!-- Konten Tab -->
                <div data-aos="fade-up" data-aos-delay="200">
                    {{-- Hasil untuk Berita --}}
                    <div x-show="tab === 'berita'" class="space-y-8">
                        @forelse($posts as $post)
                            <article class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                                <span
                                    class="text-xs font-semibold text-blue-800 bg-blue-100 px-2 py-1 rounded-full">{{ $post->category->name }}</span>
                                <a href="#">
                                    <h3 class="mt-3 text-xl font-bold text-blue-900 hover:text-yellow-600">
                                        {{ $post->title }}</h3>
                                </a>
                                <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                                    {{ Str::limit(strip_tags($post->content), 200) }}</p>
                                <div class="mt-3 text-xs text-gray-500">Oleh {{ $post->user->name }} •
                                    {{ $post->published_at->isoFormat('D MMM YYYY') }}</div>
                            </article>
                        @empty
                            <p class="text-center text-gray-500 py-8">Tidak ada hasil ditemukan di Berita & Artikel.</p>
                        @endforelse
                        @if ($posts->hasPages())
                            <div class="mt-8">{{ $posts->links() }}</div>
                        @endif
                    </div>

                    {{-- Hasil untuk Halaman --}}
                    <div x-show="tab === 'halaman'" class="space-y-8" style="display: none;">
                        @forelse($pages as $page)
                            <article class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                                <a href="{{ route('profil.pages.show', $page->slug) }}">
                                    <h3 class="text-xl font-bold text-blue-900 hover:text-yellow-600">{{ $page->title }}
                                    </h3>
                                </a>
                                <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                                    {{ Str::limit(strip_tags($page->content), 200) }}</p>
                            </article>
                        @empty
                            <p class="text-center text-gray-500 py-8">Tidak ada hasil ditemukan di Halaman.</p>
                        @endforelse
                        @if ($pages->hasPages())
                            <div class="mt-8">{{ $pages->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
@endsection
