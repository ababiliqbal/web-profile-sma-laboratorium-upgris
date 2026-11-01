    @extends('layouts.template') {{-- Ganti dengan nama layout publik Anda --}}

    {{-- Meta tags SEO dinamis untuk setiap artikel --}}
    @section('title', ($post->meta_title ?? $post->title) . ' - ' . ($settings['school_name'] ?? 'Website Sekolah'))
    @section('description', $post->meta_description ?? Str::limit(strip_tags($post->content), 160))
    @section('og_image', $post->image_path ? asset('storage/' . $post->image_path) : null)

    @section('content')
        <main id="main-content" class="pt-24 pb-16">

            <article>
                <header class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 text-center" data-aos="fade-up">

                    <!-- Breadcrumb -->
                    <nav class="flex justify-center mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li>
                                <div class="flex items-center">
                                    <a href="/"
                                        class="text-blue-600 hover:text-yellow-500 transition-colors">Beranda</a>
                                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <a href="{{ route('berita.posts.index') }}"
                                        class="text-blue-600 hover:text-yellow-500 transition-colors">Berita</a>
                                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </li>
                            <li aria-current="page">
                                <span class="text-gray-700 font-medium">{{ $post->category->name }}</span>
                            </li>
                        </ol>
                    </nav>

                    <!-- Tag kategori -->
                    <div class="mb-4">
                        <a href="{{ route('berita.posts.category', $post->category->slug) }}"
                            class="text-yellow-600 font-semibold uppercase tracking-wider text-xs sm:text-sm inline-block bg-yellow-50 px-3 py-1 rounded-full shadow-sm hover:bg-yellow-100 transition">
                            {{ $post->category->name }}
                        </a>
                    </div>

                    <!-- Judul artikel -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-blue-900 leading-tight tracking-tight">
                        {{ $post->title }}
                    </h1>

                    <!-- Informasi penulis dan waktu -->
                    <div class="mt-6 text-gray-500 flex flex-wrap justify-center items-center gap-3 text-sm">
                        <span>Oleh <strong class="text-gray-700">{{ $post->user->name }}</strong></span>
                        <span class="hidden sm:inline text-gray-300">|</span>
                        <time
                            datetime="{{ $post->published_at->toW3cString() }}">{{ $post->published_at->isoFormat('D MMMM YYYY') }}</time>
                    </div>

                </header>

                {{-- Gambar Unggulan --}}
                @if ($post->image_path)
                    <figure class="max-w-6xl mx-auto mt-12 px-4 sm:px-6 lg:px-8" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->image_alt ?? $post->title }}"
                            class="w-full h-auto rounded-2xl shadow-2xl object-cover">
                        <figcaption class="mt-3 text-center text-sm text-gray-500">
                            {{ $post->image_alt }}
                        </figcaption>
                    </figure>
                @endif

                {{-- Konten Artikel --}}
                <section class="mt-12">
                    <div class="prose prose-lg prose-blue max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up"
                        data-aos-delay="200">
                        {!! $post->content !!}
                    </div>
                </section>

                {{-- Tags & Tombol Bagikan --}}
                <footer class="max-w-4xl mx-auto mt-16 px-4 sm:px-6 lg:px-8" data-aos="fade-up">

                    <div
                        class="border-t border-gray-200 pt-10 flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                        @if ($post->tags->isNotEmpty())
                            <!-- Tags -->
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-sm font-semibold text-gray-700">Tags:</span>
                                @foreach ($post->tags as $tag)
                                    <a href="{{ route('berita.posts.tag', $tag->slug) }}"
                                        class="text-xs font-medium bg-gray-100 hover:bg-yellow-100 text-gray-700 px-3 py-1 rounded-full transition">#{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        @endif

                        <!-- Share Buttons -->
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-semibold text-gray-700">Bagikan:</span>

                            <!-- Facebook -->
                            <a href="#" aria-label="Bagikan ke Facebook"
                                class="p-2 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200 transition-all duration-300 hover:scale-105 hover:-translate-y-[1px] shadow-sm">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22 12C22 6.477 17.523 2 12 2S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.877v-6.987H7.898v-2.89h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.63.772-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 16.991 22 12z" />
                                </svg>
                            </a>

                            <!-- Twitter -->
                            <a href="#" aria-label="Bagikan ke Twitter"
                                class="p-2 rounded-full bg-blue-100 text-sky-500 hover:bg-blue-200 transition-all duration-300 hover:scale-105 hover:-translate-y-[1px] shadow-sm">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19.633 7.997c.013.18.013.36.013.54 0 5.508-4.194 11.856-11.856 11.856-2.36 0-4.558-.693-6.408-1.874.327.038.655.05.995.05 1.957 0 3.755-.655 5.187-1.768-1.827-.037-3.367-1.238-3.898-2.893.253.05.507.075.772.075.373 0 .747-.05 1.095-.145-1.913-.387-3.354-2.073-3.354-4.099v-.05c.56.312 1.203.498 1.888.52-1.13-.755-1.878-2.043-1.878-3.502 0-.773.208-1.49.572-2.112 2.086 2.56 5.2 4.243 8.717 4.42-.072-.312-.109-.637-.109-.973 0-2.346 1.899-4.245 4.245-4.245 1.223 0 2.33.517 3.106 1.35.972-.19 1.884-.547 2.707-1.038-.318.998-.998 1.835-1.885 2.36.862-.097 1.684-.332 2.449-.665-.57.848-1.292 1.596-2.12 2.192z" />
                                </svg>
                            </a>

                            <!-- WhatsApp -->
                            <a href="#" aria-label="Bagikan ke WhatsApp"
                                class="p-2 rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition-all duration-300 hover:scale-105 hover:-translate-y-[1px] shadow-sm">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.02 2c-5.52 0-10 4.478-10 10 0 1.779.467 3.449 1.271 4.904L2 22l5.23-1.357C8.687 21.533 10.35 22 12.02 22c5.523 0 10-4.477 10-10s-4.478-10-10-10zm5.184 14.279c-.217.602-1.265 1.179-1.748 1.241-.448.06-1.017.086-3.201-.677-2.691-1.059-4.412-3.796-4.547-3.972-.133-.179-1.087-1.45-1.087-2.767 0-1.316.685-1.964.927-2.23.24-.267.523-.334.697-.334.175 0 .35.002.503.009.161.007.377-.061.59.454.217.522.737 1.812.803 1.94.066.127.11.275.02.443-.088.166-.132.27-.259.418-.133.154-.279.344-.399.46-.133.127-.271.267-.116.526.154.26.683 1.128 1.46 1.832 1.004.925 1.85 1.213 2.12 1.346.267.133.421.111.577-.066.154-.178.665-.775.842-1.04.175-.26.35-.216.588-.13.238.088 1.501.707 1.757.836.259.129.43.192.49.3.06.106.06.619-.157 1.221z" />
                                </svg>
                            </a>
                        </div>

                    </div>
                </footer>

                {{-- Kotak Penulis --}}
                @if ($authorProfile)
                    <section class="max-w-4xl mx-auto mt-20 px-4 sm:px-6 lg:px-8" data-aos="fade-up">
                        <div
                            class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200 shadow-sm flex flex-col sm:flex-row sm:items-start gap-6 transition-all duration-300 hover:shadow-md">

                            <!-- Wrapper gambar agar bisa dipusatkan hanya di mobile -->
                            <div class="flex justify-center sm:block">
                                <img class="w-24 h-24 rounded-full object-cover border-4 border-blue-100 shadow-sm"
                                    src="{{ $authorProfile->image_path ? asset('storage/' . $authorProfile->image_path) : 'https://placehold.co/100x100/E2E8F0/334155?text=' . substr($authorProfile->name, 0, 1) }}"
                                    alt="{{ $authorProfile->image_alt ?? 'Foto ' . $authorProfile->name }}">
                            </div>

                            <div class="flex-1 text-center sm:text-left">
                                <p class="text-xs uppercase text-gray-400 tracking-wide">Ditulis oleh</p>
                                <h3 class="text-2xl font-semibold text-blue-900 mt-1">{{ $authorProfile->name }}</h3>
                                <p class="mt-2 text-gray-600 text-sm leading-relaxed max-w-prose mx-auto sm:mx-0">
                                    {{ $authorProfile->biography ?? $authorProfile->position }}
                                </p>
                            </div>
                        </div>
                    </section>
                @endif
            </article>

            {{-- Artikel Terkait --}}
            @if ($relatedPosts->isNotEmpty())
                <section class="py-20 bg-gray-50 mt-24">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div data-aos="fade-up" class="text-center mb-12">
                            <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-900 tracking-tight">Baca Juga Artikel
                                Lainnya</h2>
                            <p class="mt-3 text-base sm:text-lg text-gray-600">Jelajahi lebih banyak berita menarik dari
                                kategori
                                serupa.</p>
                        </div>

                        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                            <!-- Item Artikel -->
                            @foreach ($relatedPosts as $relatedPost)
                                <article data-aos="fade-up" data-aos-delay="100"
                                    class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-500 overflow-hidden group flex flex-col">
                                    <a href="{{ route('berita.posts.show', $relatedPost->slug) }}"
                                        class="overflow-hidden block">
                                        <img src="{{ $relatedPost->image_path ? asset('storage/' . $relatedPost->image_path) : 'https://placehold.co/600x400/34D399/FFFFFF?text=' . substr($relatedPost->category->name, 0) }}"
                                            alt="{{ $relatedPost->image_alt ?? $relatedPost->title }}"
                                            class="w-full h-56 object-cover transition-transform duration-500 ease-in-out group-hover:scale-105" />
                                    </a>
                                    <div class="p-6 flex flex-col flex-grow">
                                        <span
                                            class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full w-fit">Prestasi</span>
                                        <a href="{{ route('berita.posts.show', $relatedPost->slug) }}" class="mt-4 block">
                                            <h3
                                                class="text-xl font-semibold text-blue-900 group-hover:text-yellow-500 transition-colors duration-300 leading-snug">
                                                {{ $relatedPost->title }}
                                            </h3>
                                        </a>
                                        <div class="mt-auto pt-4 text-sm text-gray-500">
                                            <time
                                                datetime="{{ $relatedPost->published_at->toW3cString() }}">{{ $relatedPost->published_at->isoFormat('D MMMM YYYY') }}</time>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

        </main>
    @endsection
