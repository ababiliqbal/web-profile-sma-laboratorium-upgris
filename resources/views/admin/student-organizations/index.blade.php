@extends('layouts.app')

@section('title', 'Manajemen Organisasi Siswa')

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
        <div class="flex justify-between items-center p-6 border-b border-border">
            <h3 class="text-xl font-bold text-text-dark">Daftar Organisasi Siswa</h3>

            {{-- Perbaikan: Tombol dilindungi permission --}}
            @can('manage-student-organizations')
                <a href="{{ route('dashboard.student-organizations.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> <span class="hidden sm:inline">Tambah Organisasi</span>
                </a>
            @endcan
        </div>

        <div class="p-6">
            @if ($organizations->isEmpty())
                <div class="text-center p-10">
                    <div class="text-text-light">
                        <i class="fas fa-users fa-3x"></i>
                        <p class="mt-4">Belum ada data organisasi siswa yang ditambahkan.</p>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($organizations as $organization)
                        <div class="bg-white rounded-xl shadow-soft overflow-hidden flex flex-col group relative">
                            <div class="h-40 w-full bg-gray-100 flex items-center justify-center p-4">
                                @if ($organization->logo_path)
                                    {{-- Perbaikan: Menambahkan image_alt --}}
                                    <img src="{{ asset('storage/' . $organization->logo_path) }}"
                                        alt="{{ $organization->image_alt ?? $organization->name }}"
                                        class="h-full w-full object-contain">
                                @else
                                    <i class="fas fa-users text-5xl text-gray-400"></i>
                                @endif
                            </div>
                            <div class="p-4 flex flex-col flex-grow">
                                <h4 class="font-bold text-lg text-text-dark mb-1">{{ $organization->name }}</h4>
                                <p class="text-sm text-text-light flex-grow">
                                    Pembina:
                                    {{-- Perbaikan: Menggunakan relasi 'supervisor' --}}
                                    <span
                                        class="font-medium text-text-dark">{{ $organization->supervisor->name ?? 'N/A' }}</span>
                                </p>
                            </div>

                            {{-- Dropdown Aksi dilindungi permission --}}
                            @can('manage-student-organizations')
                                <div x-data="{ open: false }" class="absolute top-3 right-3">
                                    <button @click="open = !open"
                                        class="bg-white/70 backdrop-blur-sm text-text-dark hover:bg-primary-light hover:text-primary rounded-full w-8 h-8 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-primary">
                                        <i class="fas fa-ellipsis-v text-sm"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-transition
                                        class="absolute right-0 z-20 mt-2 w-48 origin-top-right bg-surface rounded-xl shadow-medium ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        style="display: none;">
                                        <div class="py-1">
                                            <a href="{{ route('dashboard.student-organizations.edit', $organization) }}"
                                                class="dropdown-item">
                                                <i class="fas fa-edit w-5"></i> Edit
                                            </a>
                                            <form action="{{ route('dashboard.student-organizations.destroy', $organization) }}"
                                                method="POST"
                                                onsubmit="return confirm('Anda yakin ingin menghapus organisasi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="dropdown-item text-red-600 hover:!bg-red-50 w-full text-left">
                                                    <i class="fas fa-trash-alt w-5"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        {{-- Menambahkan Paginasi jika ada --}}
        @if ($organizations->hasPages())
            <div class="p-6 border-t border-border">
                {{ $organizations->links() }}
            </div>
        @endif
    </div>
@endsection
