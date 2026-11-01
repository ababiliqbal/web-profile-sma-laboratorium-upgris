@extends('layouts.app')

@section('title', 'Manajemen Postingan')

@section('content')
    {{-- Notifikasi Sukses dengan animasi fade out --}}
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

                <h3 class="text-xl font-bold text-text-dark">Daftar Postingan</h3>

                {{-- (PERUBAHAN DI SINI) Form Pencarian --}}
                <form action="{{ route('dashboard.posts.index') }}" method="GET" class="flex items-center gap-2">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-text-light"></i>
                        {{-- 'name="search"' adalah kuncinya --}}
                        <input type="text" name="search" placeholder="Cari postingan..."
                            class="input-form pl-10 w-48 sm:w-64 !mt-0" value="{{ request('search') }}">
                    </div>
                    {{-- Tombol submit bisa disembunyikan jika ingin pencarian terjadi saat menekan Enter --}}
                    {{-- <button type="submit" class="btn btn-secondary">Cari</button> --}}
                    <a href="{{ route('dashboard.posts.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span class="hidden sm:inline">Tambah Baru</span>
                    </a>
                </form>
                {{-- AKHIR PERUBAHAN --}}

            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-text-light">
                <thead class="text-xs text-text-light uppercase bg-background">
                    <tr>
                        <th scope="col" class="px-6 py-3">Judul & Penulis</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Tanggal Terbit</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr class="bg-surface border-b border-border hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @if ($post->image_path)
                                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="Gambar Post"
                                            class="w-16 h-10 object-cover rounded-lg">
                                    @else
                                        <div
                                            class="w-16 h-10 bg-gray-200 rounded-lg flex items-center justify-center text-text-light">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-semibold text-text-dark whitespace-nowrap">
                                            {{ Str::limit($post->title, 40) }}</div>
                                        <div class="text-xs text-text-light">oleh {{ $post->user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $post->category->name }}</td>
                            <td class="px-6 py-4">
                                @if ($post->status == 'published')
                                    <span
                                        class="px-3 py-1 text-xs font-bold text-green-800 bg-green-200 rounded-full">Published</span>
                                @else
                                    <span
                                        class="px-3 py-1 text-xs font-bold text-orange-800 bg-orange-200 rounded-full">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{-- Dropdown Aksi yang Elegan --}}
                                <div x-data="{ open: false }" class="relative">
                                    <button @click="open = !open"
                                        class="text-text-light hover:text-primary rounded-full p-2 focus:outline-none focus:ring-2 focus:ring-primary-light">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-transition
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right bg-surface rounded-xl shadow-medium ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        style="display: none;">
                                        <div class="py-1">
                                            <a href="{{ route('dashboard.posts.edit', $post) }}" class="dropdown-item">
                                                <i class="fas fa-edit w-5"></i> Edit
                                            </a>
                                            <form action="{{ route('dashboard.posts.destroy', $post) }}" method="POST"
                                                onsubmit="return confirm('Anda yakin ingin menghapus postingan ini secara permanen?');">
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-10">
                                <div class="text-text-light">
                                    <i class="fas fa-folder-open fa-3x"></i>
                                    <p class="mt-4">Tidak ada data postingan ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($posts->hasPages())
            <div class="p-6 border-t border-border">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
