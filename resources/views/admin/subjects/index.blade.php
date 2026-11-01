@extends('layouts.app')

@section('title', 'Manajemen Mata Pelajaran')

@section('content')
    {{-- Notifikasi Sukses atau Error --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-r-lg shadow-soft" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-r-lg shadow-soft" role="alert">
            <p class="font-bold">Gagal!</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-surface rounded-2xl shadow-soft overflow-hidden">
        {{-- Header Tabel --}}
        <div class="flex justify-between items-center p-6 border-b border-border">
            <h3 class="text-xl font-bold text-text-dark">Daftar Mata Pelajaran</h3>

            @can('manage-subjects')
                <a href="{{ route('dashboard.subjects.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> <span class="hidden sm:inline">Tambah Mapel</span>
                </a>
            @endcan
        </div>

        {{-- Tabel Data --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-text-light">
                <thead class="text-xs text-text-light uppercase bg-background">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Mata Pelajaran</th>
                        <th scope="col" class="px-6 py-3">Jumlah Guru Pengampu</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subjects as $subject)
                        <tr class="bg-surface border-b border-border hover:bg-gray-50">
                            <td data-label="Nama Mata Pelajaran" class="px-6 py-4 font-semibold text-text-dark">
                                {{ $subject->name }}</td>
                            <td data-label="Jumlah Guru" class="px-6 py-4">{{ $subject->staffs_count }}</td>
                            <td data-label="Aksi" class="px-6 py-4 text-center">
                                {{-- Dropdown Aksi --}}
                                <div x-data="{ open: false }" class="relative">
                                    <button @click="open = !open"
                                        class="text-text-light hover:text-primary rounded-full p-2 focus:outline-none focus:ring-2 focus:ring-primary-light">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-transition
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right bg-surface rounded-xl shadow-medium ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        style="display: none;">
                                        <div class="py-1">
                                            @can('manage-subjects')
                                                <a href="{{ route('dashboard.subjects.edit', $subject) }}"
                                                    class="dropdown-item">
                                                    <i class="fas fa-edit w-5"></i> Edit
                                                </a>
                                            @endcan

                                            @can('manage-subjects')
                                                <form action="{{ route('dashboard.subjects.destroy', $subject) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Anda yakin ingin menghapus mata pelajaran ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="dropdown-item text-red-600 hover:!bg-red-50 w-full text-left">
                                                        <i class="fas fa-trash-alt w-5"></i> Hapus
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center p-10">
                                <div class="text-text-light">
                                    <i class="fas fa-book-open fa-3x"></i>
                                    <p class="mt-4">Tidak ada data mata pelajaran ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($subjects->hasPages())
            <div class="p-6 border-t border-border">
                {{ $subjects->links() }}
            </div>
        @endif
    </div>
@endsection
