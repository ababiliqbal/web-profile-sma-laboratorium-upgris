@extends('layouts.template')


{{-- Meta tags SEO --}}
@section('title', 'Staf & Tenaga Pendidik - ' . ($settings['school_name'] ?? 'Website Sekolah'))
@section('description', 'Mengenal lebih dekat para pendidik dan staf profesional yang berdedikasi di ' .
    ($settings['school_name'] ?? 'sekolah kami') . '.')

@section('content')

    {{-- MAIN CONTENT --}}

    <main id="main-content" class="py-16 sm:py-24" x-data="staffPage()" x-init="init()">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Halaman --}}
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="text-yellow-500 font-semibold uppercase tracking-wider">Tim Kami</span>
                <h1 class="text-4xl font-extrabold text-blue-900 mt-2 break-words">Staf & Tenaga Pendidik</h1>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Mengenal lebih dekat para pendidik dan staf profesional
                    yang berdedikasi.</p>
            </div>

            {{-- Filter dan Pencarian --}}
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-12" data-aos="fade-up"
                data-aos-delay="100">

                <div class="flex flex-wrap justify-center gap-2">
                    <button @click="currentFilter = 'semua'"
                        :class="{ 'bg-blue-700 text-white': currentFilter === 'semua', 'bg-white text-gray-700 hover:bg-gray-100': currentFilter !== 'semua' }"
                        class="px-4 py-2 text-sm font-semibold rounded-lg shadow-md transition-colors">Semua</button>
                    <button @click="currentFilter = 'kepemimpinan'"
                        :class="{ 'bg-blue-700 text-white': currentFilter === 'kepemimpinan', 'bg-white text-gray-700 hover:bg-gray-100': currentFilter !== 'kepemimpinan' }"
                        class="px-4 py-2 text-sm font-semibold rounded-lg shadow-md transition-colors">Kepemimpinan</button>
                    <button @click="currentFilter = 'teacher'"
                        :class="{ 'bg-blue-700 text-white': currentFilter === 'teacher', 'bg-white text-gray-700 hover:bg-gray-100': currentFilter !== 'teacher' }"
                        class="px-4 py-2 text-sm font-semibold rounded-lg shadow-md transition-colors">Guru</button>
                    <button @click="currentFilter = 'staff'"
                        :class="{ 'bg-blue-700 text-white': currentFilter === 'staff', 'bg-white text-gray-700 hover:bg-gray-100': currentFilter !== 'staff' }"
                        class="px-4 py-2 text-sm font-semibold rounded-lg shadow-md transition-colors">Staf</button>
                </div>

                <div class="relative w-full md:w-auto">
                    <input type="text" placeholder="Cari nama..." x-model.debounce.300ms="searchQuery"
                        class="w-full md:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Grid untuk mengampilkan Staf --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

                <template x-for="person in filteredStaff" :key="person.id">
                    <div x-transition data-aos="fade-up">
                        <button @click="openModal(person)"
                            class="w-full text-left bg-white rounded-xl shadow-lg overflow-hidden group transform hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                            <div class="relative">
                                <img class="w-full h-72 object-cover" :src="person.foto"
                                    :alt="person.imageAlt ? person.imageAlt : 'Foto ' + person.nama">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-blue-900 leading-snug" x-text="person.nama"></h3>
                                <p class="mt-1 text-sm text-yellow-600 font-semibold" x-text="person.posisi"></p>
                            </div>
                        </button>
                    </div>
                </template>

                {{-- Tampilan jika hasil filter kosong --}}
                <template x-if="filteredStaff.length === 0">
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <i class="fas fa-users-slash fa-3x"></i>
                        <p class="mt-4"
                            x-text="searchQuery ? 'Tidak ada staf yang cocok dengan pencarian.' : 'Tidak ada staf dalam kategori ini.'">
                        </p>
                    </div>
                </template>

            </div>
        </div>

        {{-- Modal --}}
        <div id="detail-modal" x-show="isModalOpen" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4"
            role="dialog" aria-modal="true" style="display: none;">

            <div class="absolute inset-0 bg-gray-900/70 backdrop-blur-sm" @click="isModalOpen = false"></div>

            <div @click.away="isModalOpen = false" x-show="isModalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">

                <button @click="isModalOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-800">
                    <span class="sr-only">Tutup modal</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                <div class="grid md:grid-cols-3">
                    <div class="md:col-span-1">
                        <img class="w-full h-full object-cover md:rounded-l-2xl" :src="selectedPerson.foto"
                            :alt="'Foto detail ' + selectedPerson.nama">
                    </div>

                    <div class="md:col-span-2 p-8 md:p-10">
                        <h2 class="text-3xl font-extrabold text-blue-900" x-text="selectedPerson.nama"></h2>
                        <p class="mt-1 text-lg font-semibold text-yellow-600" x-text="selectedPerson.posisi"></p>

                        <div class="mt-6 border-t border-gray-200 pt-6 space-y-4 text-sm">
                            <div>
                                <h4 class="font-semibold text-gray-500">NIP</h4>
                                <p class="text-gray-800" x-text="selectedPerson.nip"></p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-500">Status Kepegawaian</h4>
                                <p class="text-gray-800" x-text="selectedPerson.status"></p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-500">Email</h4>
                                <a :href="'mailto:' + selectedPerson.email" class="text-blue-600 hover:underline"
                                    x-text="selectedPerson.email"></a>
                            </div>
                            <div x-show="selectedPerson.type === 'teacher' && selectedPerson.mapel.length > 0">
                                <h4 class="font-semibold text-gray-500">Mata Pelajaran Diampu</h4>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <template x-for="subject in selectedPerson.mapel" :key="subject">
                                        <span class="px-3 py-1 text-xs font-bold text-blue-800 bg-blue-100 rounded-full"
                                            x-text="subject"></span>
                                    </template>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-500">Biografi</h4>
                                <p class="text-gray-800 leading-relaxed" x-text="selectedPerson.bio"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


<script>
    function staffPage() {
        return {
            currentFilter: 'semua',
            searchQuery: '',
            isModalOpen: false,
            selectedPerson: {},

            // Semua data guru & staf sekarang ada di sini
            staff: @json($staffData),

            // Fungsi getter untuk memfilter data secara otomatis
            get filteredStaff() {
                if (this.searchQuery.length > 2) {
                    return this.staff.filter(person =>
                        person.nama.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                }
                if (this.currentFilter === 'semua') {
                    return this.staff;
                }
                return this.staff.filter(person => person.kategori === this.currentFilter);
            },

            // Fungsi untuk membuka modal
            openModal(person) {
                this.selectedPerson = person;
                this.isModalOpen = true;
            },
        }
    }
</script>
