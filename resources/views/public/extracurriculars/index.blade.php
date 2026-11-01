@extends('layouts.template')

{{-- Meta tags SEO --}}
@section('title', 'Kegiatan Ekstrakurikuler - ' . ($settings['school_name'] ?? 'Website Sekolah'))
@section('description',
    'Temukan berbagai kegiatan ekstrakurikuler yang kami tawarkan untuk mengembangkan minat, bakat,
    dan kreativitas siswa di luar jam pelajaran.')

@section('content')
    <main id="main-content" class="py-16 sm:py-24" x-data="ekskulPage()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-yellow-500 font-semibold uppercase tracking-wider">Kembangkan Potensi</span>
                <h1 class="text-4xl font-extrabold text-blue-900 mt-2 break-words">Kegiatan Ekstrakurikuler</h1>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Wadah bagi para siswa untuk menyalurkan minat, bakat,
                    dan
                    kreativitas di luar jam pelajaran.</p>
            </div>

            {{-- Grid untuk menampilkan Ekstrakurikuler --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse ($extracurriculars as $ekskul)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                        <button
                            @click="openModal({{ json_encode([
                                'nama' => $ekskul->name,
                                'deskripsi' => $ekskul->description ?? 'Tidak ada deskripsi.',
                                'logo' => $ekskul->logo_path
                                    ? asset('storage/' . $ekskul->logo_path)
                                    : 'https://placehold.co/500x500/E2E8F0/334155?text=' . urlencode($ekskul->name),
                                'jadwal' => $ekskul->schedule ?? 'Belum ditentukan',
                                'pembina' => $ekskul->coach->name ?? 'Belum ditentukan',
                            ]) }})"
                            class="w-full h-80 bg-white rounded-xl shadow-lg overflow-hidden group relative transform hover:-translate-y-2 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">

                            <div class="absolute inset-0 flex items-center justify-center p-8">
                                <img class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-300"
                                    src="{{ $ekskul->logo_path ? asset('storage/' . $ekskul->logo_path) : 'https://placehold.co/500x500/E2E8F0/334155?text=' . urlencode($ekskul->name) }}"
                                    alt="{{ $ekskul->image_alt ?? 'Logo ' . $ekskul->name }}">
                            </div>

                            <div
                                class="absolute inset-0 bg-blue-900/95 text-white p-6 flex flex-col justify-center items-center text-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <h3 class="text-2xl font-bold text-yellow-400">{{ $ekskul->name }}</h3>
                                <div class="mt-4 text-sm space-y-2">
                                    <p><strong class="font-semibold">Jadwal:</strong>
                                        <span>{{ $ekskul->schedule ?? '-' }}</span>
                                    </p>
                                    <p><strong class="font-semibold">Pembina:</strong>
                                        <span>{{ $ekskul->coach->name ?? '-' }}</span>
                                    </p>
                                </div>
                            </div>
                        </button>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <i class="fas fa-basketball-ball fa-3x"></i>
                        <p class="mt-4">Belum ada data ekstrakurikuler untuk ditampilkan.</p>
                    </div>
                @endforelse
            </div>

        </div>

        <!-- Modal -->

        <div id="ekskul-modal" x-show="isModalOpen" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4" role="dialog"
            aria-modal="true" style="display: none;">

            <div @click.away="isModalOpen = false" x-show="isModalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] flex flex-col md:flex-row overflow-hidden">

                <button @click="isModalOpen = false" class="absolute top-4 right-4 z-10 text-gray-400 hover:text-gray-800">
                    <span class="sr-only">Tutup modal</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                <div class="w-full md:w-1/3 flex-shrink-0 bg-gray-100 flex items-center justify-center p-8">
                    <img class="max-w-full max-h-48 object-contain" :src="selectedEkskul.logo"
                        :alt="'Logo ' + selectedEkskul.nama">
                </div>

                <div class="flex-grow p-8 md:p-10 overflow-y-auto">
                    <h2 class="text-3xl font-extrabold text-blue-900" x-text="selectedEkskul.nama"></h2>

                    <div class="mt-6 border-t border-gray-200 pt-6 space-y-5 text-base">
                        <div>
                            <h4 class="font-bold text-gray-800">Deskripsi Kegiatan</h4>
                            <p class="mt-1 text-gray-600 leading-relaxed" x-text="selectedEkskul.deskripsi"></p>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Jadwal</h4>
                            <p class="mt-1 text-gray-600" x-text="selectedEkskul.jadwal"></p>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Pembina</h4>
                            <p class="mt-1 text-gray-600" x-text="selectedEkskul.pembina"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function ekskulPage() {
            return {
                isModalOpen: false,
                selectedEkskul: {},

                // Fungsi untuk membuka modal dengan data yang dikirim dari tombol
                openModal(ekskulData) {
                    this.selectedEkskul = ekskulData;
                    this.isModalOpen = true;
                }
            }
        }
    </script>
@endsection
