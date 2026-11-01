@extends('layouts.template')

{{-- Mengisi meta tags SEO secara dinamis dari database --}}
@section('title', ($page->meta_title ?? $page->title) . ' - ' . ($settings['school_name'] ?? 'Website Sekolah'))
@section('description', $page->meta_description ?? Str::limit(strip_tags($page->content), 160))
@section('og_image', $page->image_path ? asset('storage/' . $page->image_path) : null)

@section('content')
    <main id="main-content" class="py-16 sm:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Judul Halaman --}}
            <div class="mb-12" data-aos="fade-up">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 text-center tracking-tight leading-tight">
                    {{ $page->title }}
                </h1>
            </div>

            {{-- Gambar Header Halaman --}}
            <div class="mb-12" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ $page->image_path ? asset('storage/' . $page->image_path) : 'https://placehold.co/1200x600/1E3A8A/FFFFFF?text=Gambar+Halaman' }}"
                    alt="{{ $page->image_alt ?? $page->title }}" class="w-full h-auto rounded-2xl shadow-xl object-cover">
            </div>

            {{-- Isi Konten --}}
            <div class="prose prose-lg max-w-none static-content space-y-6 text-gray-700 leading-relaxed" data-aos="fade-up"
                data-aos-delay="200">
                {!! $page->content !!}
            </div>

            {{-- Lampiran Dokumen --}}
            @if ($page->documents->isNotEmpty())
                <div class="mt-16" data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-blue-900 mb-6 border-b pb-4">Dokumen Terkait</h2>
                    <ul class="space-y-3">
                        @foreach ($page->documents as $document)
                            <li>
                                <a href="{{ route('documents.download', $document) }}"
                                    class="flex items-center gap-3 bg-gray-50 hover:bg-primary-light p-4 rounded-lg transition-colors duration-200 border border-border">
                                    <i class="fas fa-file-pdf text-primary text-2xl"></i>
                                    <div>
                                        <span class="font-semibold text-text-dark">{{ $document->title }}</span>
                                        <span class="text-sm text-text-light block">Unduh File</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </main>
@endsection
