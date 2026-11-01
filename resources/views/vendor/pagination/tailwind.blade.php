@if ($paginator->hasPages())
    <nav class="mt-16 flex justify-center" aria-label="Navigasi Paginasi" data-aos="fade-up">
        <ul class="inline-flex items-center justify-center flex-wrap gap-2 text-sm">

            {{-- Tombol Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span
                        class="flex items-center px-4 py-2 rounded-lg border border-gray-300 text-gray-400 bg-white cursor-not-allowed">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Sebelumnya</span>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="flex items-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Sebelumnya</span>
                    </a>
                </li>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-500 bg-white cursor-default">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span aria-current="page"
                                    class="px-4 py-2 rounded-lg bg-blue-700 text-white font-semibold cursor-default shadow-sm">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                    aria-label="Halaman {{ $page }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Berikutnya --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="flex items-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <span>Selanjutnya</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </li>
            @else
                <li>
                    <span
                        class="flex items-center px-4 py-2 rounded-lg border border-gray-300 text-gray-400 bg-white cursor-not-allowed">
                        <span>Selanjutnya</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif
