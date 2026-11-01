@extends('layouts.app')

@section('title', 'Manajemen Prestasi')

@section('content')
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-r-lg shadow-soft" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-surface rounded-2xl shadow-soft">
        <div class="p-6 border-b border-border">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <h3 class="text-xl font-bold text-text-dark">Daftar Prestasi</h3>
                <div class="flex items-center gap-2">
                    <form action="{{ route('dashboard.achievements.index') }}" method="GET">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-text-light"></i>
                            <input type="text" name="search" placeholder="Cari prestasi..."
                                class="input-form pl-10 w-48 sm:w-64 !mt-0" value="{{ request('search') }}">
                        </div>
                    </form>

                    {{-- Perbaikan: Tombol dilindungi permission --}}
                    @can('manage-achievements')
                        <a href="{{ route('dashboard.achievements.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> <span class="hidden sm:inline">Tambah Prestasi</span>
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-text-light">
                <thead class="text-xs text-text-light uppercase bg-background">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Prestasi</th>
                        <th scope="col" class="px-6 py-3">Tingkat</th>
                        <th scope="col" class="px-6 py-3">Tipe</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($achievements as $achievement)
                        <tr class="bg-surface border-b border-border hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @if ($achievement->image_path)
                                        {{-- Perbaikan: Menambahkan image_alt --}}
                                        <img src="{{ asset('storage/' . $achievement->image_path) }}"
                                            alt="{{ $achievement->image_alt ?? $achievement->title }}"
                                            class="w-16 h-10 object-cover rounded-lg">
                                    @else
                                        <div
                                            class="w-16 h-10 bg-gray-200 rounded-lg flex items-center justify-center text-text-light">
                                            <i class="fas fa-trophy"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-semibold text-text-dark">{{ Str::limit($achievement->title, 50) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 capitalize">{{ $achievement->level }}</td>
                            <td class="px-6 py-4">
                                {{-- Perbaikan: Tampilan badge untuk tipe --}}
                                @if ($achievement->type == 'student')
                                    <span
                                        class="px-3 py-1 text-xs font-bold text-blue-800 bg-blue-200 rounded-full">Siswa</span>
                                @else
                                    <span
                                        class="px-3 py-1 text-xs font-bold text-purple-800 bg-purple-200 rounded-full">Sekolah</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $achievement->date->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div x-data="{ open: false }" class="relative">
                                    <button @click="open = !open"
                                        class="text-text-light hover:text-primary rounded-full p-2 focus:outline-none focus:ring-2 focus:ring-primary-light"><i
                                            class="fas fa-ellipsis-v"></i></button>
                                    <div x-show="open" @click.away="open = false" x-transition
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right bg-surface rounded-xl shadow-medium ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        style="display: none;">
                                        <div class="py-1">
                                            {{-- Perbaikan: Tombol dilindungi permission --}}
                                            @can('manage-achievements')
                                                <a href="{{ route('dashboard.achievements.edit', $achievement) }}"
                                                    class="dropdown-item"><i class="fas fa-edit w-5"></i> Edit</a>
                                                <form action="{{ route('dashboard.achievements.destroy', $achievement) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Anda yakin ingin menghapus prestasi ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="dropdown-item text-red-600 hover:!bg-red-50 w-full text-left"><i
                                                            class="fas fa-trash-alt w-5"></i> Hapus</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-10">
                                <div class="text-text-light"><i class="fas fa-trophy fa-3x"></i>
                                    <p class="mt-4">Tidak ada data prestasi ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($achievements->hasPages())
            <div class="p-6 border-t border-border">
                {{ $achievements->links() }}
            </div>
        @endif
    </div>
@endsection
