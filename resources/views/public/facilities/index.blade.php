@extends('layouts.template')

{{-- Meta tags SEO --}}
@section('title', 'Fasilitas Sekolah - ' . ($settings['school_name'] ?? 'Website Sekolah'))
@section('description',
    'Jelajahi berbagai fasilitas modern dan lengkap yang kami sediakan untuk mendukung proses
    belajar mengajar di ' .
    ($settings['school_name'] ?? 'sekolah kami') .
    '.')

@section('content')
    <!-- MAIN CONTENT -->
    <main x-data="gallery" id="main-content" class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-yellow-500 font-semibold uppercase tracking-wider">Sarana & Prasarana</span>
                <h1 class="text-4xl font-extrabold text-blue-900 mt-2 break-words">Fasilitas Sekolah</h1>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Kami menyediakan lingkungan belajar yang modern, nyaman,
                    dan
                    lengkap untuk mendukung potensi setiap siswa.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <template x-for="(facility, index) in facilities" :key="facility.id">
                    <div @click="openLightbox(index)" :class="facility.span"
                        class="gallery-item relative rounded-xl shadow-lg overflow-hidden group cursor-pointer"
                        data-aos="fade-up">
                        <img :src="facility.imageUrl"
                            :alt="facility.imageAlt ? facility.imageAlt : 'Gambar ' + facility.name + ' SMA Lab UPGRIS'"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500 ease-in-out">
                        <div
                            class="gallery-overlay absolute inset-0 bg-black/60 flex flex-col justify-end p-6 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <h3 class="font-bold text-lg" x-text="facility.name"></h3>
                            <p class="text-sm" x-text="facility.description"></p>
                        </div>
                    </div>
                </template>

                {{-- Tampilan jika tidak ada fasilitas --}}
                <template x-if="facilities.length === 0">
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <i class="fas fa-building fa-3x"></i>
                        <p class="mt-4">Belum ada data fasilitas untuk ditampilkan.</p>
                    </div>
                </template>
            </div>
        </div>
        <div id="lightbox-modal" x-show="isLightboxOpen" @keydown.escape.window="isLightboxOpen = false"
            @keydown.left.window="prevImage()" @keydown.right.window="nextImage()" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4" role="dialog"
            aria-modal="true" style="display: none;">

            <button @click="isLightboxOpen = false" class="absolute top-4 right-4 z-10 text-white/70 hover:text-white">
                <span class="sr-only">Tutup galeri</span>
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <button @click="prevImage()"
                class="absolute left-4 z-10 p-2 bg-white/20 rounded-full text-white/70 hover:text-white hover:bg-white/30">
                <span class="sr-only">Gambar sebelumnya</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button @click="nextImage()"
                class="absolute right-4 z-10 p-2 bg-white/20 rounded-full text-white/70 hover:text-white hover:bg-white/30">
                <span class="sr-only">Gambar berikutnya</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <div class="relative w-full max-w-5xl mx-auto px-4 py-6 flex flex-col items-center">
                <!-- Gambar Fasilitas -->
                <div class="w-full max-h-[80vh] overflow-hidden rounded-xl shadow-lg">
                    <img :src="currentImage" alt="Tampilan Penuh Fasilitas"
                        class="w-full h-full object-contain transition-transform duration-300 ease-in-out hover:scale-105">
                </div>

                <!-- Deskripsi Fasilitas -->
                <div
                    class="mt-6 text-center text-gray-100 bg-blue-900 bg-opacity-80 px-6 py-4 rounded-lg shadow-md w-full max-w-2xl">
                    <h3 class="text-2xl md:text-3xl font-semibold mb-2 text-yellow-400" x-text="currentName"></h3>
                    <p class="text-base md:text-lg leading-relaxed" x-text="currentDescription"></p>
                </div>
            </div>
        </div>
    </main>
@endsection

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('gallery', () => ({
            isLightboxOpen: false,
            currentImageIndex: 0,

            facilities: @json($facilityData),

            // Properti untuk menampilkan data di lightbox
            get currentImage() {
                return this.facilities[this.currentImageIndex]?.imageUrl || '';
            },
            get currentName() {
                return this.facilities[this.currentImageIndex]?.name || '';
            },
            get currentDescription() {
                return this.facilities[this.currentImageIndex]?.description || '';
            },

            // Fungsi untuk membuka lightbox
            openLightbox(index) {
                this.currentImageIndex = index;
                this.isLightboxOpen = true;
            },

            // Fungsi navigasi lightbox
            nextImage() {
                this.currentImageIndex = (this.currentImageIndex + 1) % this.facilities.length;
            },
            prevImage() {
                this.currentImageIndex = (this.currentImageIndex - 1 + this.facilities.length) %
                    this.facilities.length;
            }
        }));
    });
</script>
