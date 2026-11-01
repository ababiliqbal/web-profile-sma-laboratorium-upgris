@extends('layouts.app')

@section('title', 'Manajemen Galeri Album')

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
                <h3 class="text-xl font-bold text-text-dark">Daftar Album</h3>

                {{-- (PERUBAHAN DI SINI) Grup untuk form pencarian dan tombol tambah --}}
                <div class="flex items-center gap-2">
                    <form action="{{ route('dashboard.albums.index') }}" method="GET">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-text-light"></i>
                            <input type="text" name="search" placeholder="Cari album..."
                                class="input-form pl-10 w-48 sm:w-64 !mt-0" value="{{ request('search') }}">
                        </div>
                    </form>

                    @can('manage-galleries')
                        <a href="{{ route('dashboard.albums.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            <span class="hidden sm:inline">Buat Album</span>
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="p-6">
            @if ($albums->isEmpty())
                <div class="text-center p-10">
                    <div class="text-text-light">
                        <i class="fas fa-images fa-3x"></i>
                        {{-- Pesan disesuaikan jika ada filter pencarian --}}
                        <p class="mt-4">
                            @if (request('search'))
                                Tidak ada album yang cocok dengan pencarian "{{ request('search') }}".
                            @else
                                Belum ada album yang dibuat.
                            @endif
                        </p>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($albums as $album)
                        <div class="bg-white rounded-xl shadow-soft overflow-hidden group flex flex-col relative">
                            <a href="{{ route('dashboard.albums.show', $album) }}" class="block">
                                <div class="relative h-40 w-full">
                                    @if ($album->photos->first())
                                        <img src="{{ asset('storage/' . $album->photos->first()->image_path) }}"
                                            alt="{{ $album->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full bg-gray-200 flex items-center justify-center"><i
                                                class="fas fa-image text-4xl text-gray-400"></i></div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    <span
                                        class="absolute top-2 right-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">{{ $album->photos_count }}
                                        Foto</span>
                                </div>
                            </a>
                            <div class="p-4 flex-grow">
                                <h4 class="font-bold text-text-dark truncate">{{ $album->name }}</h4>
                                <p class="text-sm text-text-light">{{ $album->created_at->format('d M Y') }}</p>
                            </div>

                            @can('manage-galleries')
                                <div x-data="{ open: false }" class="absolute top-2 left-2">
                                    <button @click="open = !open"
                                        class="bg-white/70 backdrop-blur-sm text-text-dark hover:bg-primary-light hover:text-primary rounded-full w-8 h-8 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-primary">
                                        <i class="fas fa-ellipsis-h text-sm"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-transition
                                        class="absolute left-0 z-20 mt-2 w-48 origin-top-left bg-surface rounded-xl shadow-medium ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        style="display: none;">
                                        <div class="py-1">
                                            <a href="{{ route('dashboard.albums.edit', $album) }}" class="dropdown-item"><i
                                                    class="fas fa-pencil-alt w-5"></i> Edit Detail Album</a>
                                            <div class="border-t border-border my-1"></div>
                                            <form action="{{ route('dashboard.albums.destroy', $album) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus album ini? Semua foto di dalamnya akan ikut terhapus permanen.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="dropdown-item text-red-600 hover:!bg-red-50 w-full text-left"><i
                                                        class="fas fa-trash-alt w-5"></i> Hapus Album</button>
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

        @if ($albums->hasPages())
            <div class="p-6 border-t border-border">
                {{ $albums->links() }}
            </div>
        @endif
    </div>
@endsection
