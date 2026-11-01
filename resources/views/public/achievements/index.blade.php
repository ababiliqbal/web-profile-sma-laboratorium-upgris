@extends('layouts.template')

{{-- Meta tags SEO --}}
@section('title', 'Prestasi Sekolah - ' . ($settings['school_name'] ?? 'Website Sekolah'))
@section('description',
    'Daftar pencapaian dan prestasi gemilang yang telah diraih oleh siswa dan sekolah kami dalam
    berbagai bidang.')

@section('content')
    <main id="main-content" class="py-16 sm:py-24" x-data="prestasiPage()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-yellow-500 font-semibold uppercase tracking-wider">Pencapaian Gemilang</span>
                <h1 class="text-4xl font-extrabold text-blue-900 mt-2 break-words">Daftar Prestasi</h1>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Sebuah bukti nyata dari kerja keras, dedikasi, dan
                    semangat
                    juara para siswa kami.</p>
            </div>

            <div class="mb-12 flex flex-wrap justify-center gap-2" data-aos="fade-up" data-aos-delay="100">
                <button @click="currentFilter = 'semua'"
                    :class="{ 'bg-blue-700 text-white': currentFilter === 'semua', 'bg-white text-gray-700 hover:bg-gray-100': currentFilter !== 'semua' }"
                    class="px-4 py-2 text-sm font-semibold rounded-lg shadow-md transition-colors">Semua</button>
                <button @click="currentFilter = 'school'"
                    :class="{ 'bg-blue-700 text-white': currentFilter === 'school', 'bg-white text-gray-700 hover:bg-gray-100': currentFilter !== 'school' }"
                    class="px-4 py-2 text-sm font-semibold rounded-lg shadow-md transition-colors">Sekolah</button>
                <button @click="currentFilter = 'city'"
                    :class="{ 'bg-blue-700 text-white': currentFilter === 'city', 'bg-white text-gray-700 hover:bg-gray-100': currentFilter !== 'city' }"
                    class="px-4 py-2 text-sm font-semibold rounded-lg shadow-md transition-colors">Kota</button>
                <button @click="currentFilter = 'province'"
                    :class="{ 'bg-blue-700 text-white': currentFilter === 'province', 'bg-white text-gray-700 hover:bg-gray-100': currentFilter !== 'province' }"
                    class="px-4 py-2 text-sm font-semibold rounded-lg shadow-md transition-colors">Provinsi</button>
                <button @click="currentFilter = 'national'"
                    :class="{ 'bg-blue-700 text-white': currentFilter === 'national', 'bg-white text-gray-700 hover:bg-gray-100': currentFilter !== 'national' }"
                    class="px-4 py-2 text-sm font-semibold rounded-lg shadow-md transition-colors">Nasional</button>
                <button @click="currentFilter = 'international'"
                    :class="{ 'bg-blue-700 text-white': currentFilter === 'international', 'bg-white text-gray-700 hover:bg-gray-100': currentFilter !== 'international' }"
                    class="px-4 py-2 text-sm font-semibold rounded-lg shadow-md transition-colors">Internasional</button>
            </div>

            {{-- Grid untuk menampilkan Prestasi --}}
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                {{-- (PERBAIKAN KUNCI) Render dengan Blade, filter dengan Alpine --}}
                @forelse ($achievements as $achievement)
                    <div x-show="shouldShow({{ json_encode($achievement->level) }})" x-transition data-aos="fade-up"
                        class="bg-white rounded-2xl shadow-md overflow-hidden transition duration-300 hover:shadow-xl group">

                        {{-- Logika untuk warna badge berdasarkan tingkat --}}
                        @php
                            $badgeColor =
                                [
                                    'school' => 'bg-gray-100 text-gray-800',
                                    'city' => 'bg-green-100 text-green-800',
                                    'province' => 'bg-blue-100 text-blue-800',
                                    'national' => 'bg-yellow-100 text-yellow-800',
                                    'international' => 'bg-red-100 text-red-800',
                                ][$achievement->level] ?? 'bg-gray-100 text-gray-800';
                        @endphp

                        <div class="overflow-hidden relative">
                            <img src="{{ $achievement->image_path ? asset('storage/' . $achievement->image_path) : 'https://placehold.co/600x400/E2E8F0/334155?text=Prestasi' }}"
                                alt="{{ $achievement->image_alt ?? $achievement->title }}"
                                class="w-full h-96 object-cover transform transition-transform duration-500 group-hover:scale-105">
                            <span
                                class="absolute top-4 left-4 bg-opacity-90 text-xs font-semibold px-3 py-1 rounded-full {{ $badgeColor }}">
                                {{ Str::ucfirst($achievement->level) }}
                            </span>
                        </div>
                        <div class="p-6">
                            <time
                                class="text-sm text-gray-500 mb-2">{{ $achievement->date->isoFormat('D MMMM YYYY') }}</time>
                            <h3
                                class="text-2xl font-semibold text-blue-900 mb-2 leading-tight group-hover:text-blue-700 transition-colors duration-300">
                                {{ $achievement->title }}
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                                {{ $achievement->description }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <i class="fas fa-trophy fa-3x"></i>
                        <p class="mt-4">Belum ada data prestasi untuk ditampilkan.</p>
                    </div>
                @endforelse
            </div>
            {{-- Paginasi Laravel --}}
            @if ($achievements->hasPages())
                <div class="mt-16">
                    {{ $achievements->links() }}
                </div>
            @endif
        </div>
    </main>
@endsection

<script>
    function prestasiPage() {
        return {
            currentFilter: 'semua',
            shouldShow(level) {
                if (this.currentFilter === 'semua') {
                    return true;
                }
                return level === this.currentFilter;
            }
        }
    }
</script>
