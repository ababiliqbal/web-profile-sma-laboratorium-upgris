@extends('layouts.app')

@section('title', 'Manajemen Halaman')

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
            <h3 class="text-xl font-bold text-text-dark">Daftar Halaman Statis</h3>

            {{-- Tombol "Tambah" hanya muncul jika user punya izin --}}
            @can('create-pages')
                <a href="{{ route('dashboard.pages.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> <span class="hidden sm:inline">Tambah Halaman</span>
                </a>
            @endcan
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-text-light">
                <thead class="text-xs text-text-light uppercase bg-background">
                    <tr>
                        <th scope="col" class="px-6 py-3">Judul Halaman</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">URL (Slug)</th>
                        <th scope="col" class="px-6 py-3">Terakhir Diperbarui</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $page)
                        <tr class="bg-surface border-b border-border hover:bg-gray-50">
                            <td data-label="Judul" class="px-6 py-4 font-semibold text-text-dark">{{ $page->title }}</td>
                            <td data-label="Status" class="px-6 py-4">
                                @if ($page->status == 'published')
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full text-xs">Published</span>
                                @else
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full text-xs">Draft</span>
                                @endif
                            </td>
                            <td data-label="URL" class="px-6 py-4">
                                <a href="{{ route('profil.pages.show', $page->slug) }}" target="_blank"
                                    class="hover:text-primary hover:underline">
                                    /{{ $page->slug }} <i class="fas fa-external-link-alt text-xs ml-1"></i>
                                </a>
                            </td>
                            <td data-label="Diperbarui" class="px-6 py-4">{{ $page->updated_at->format('d M Y, H:i') }}</td>
                            <td data-label="Aksi" class="px-6 py-4 text-center">
                                <div x-data="{ open: false }" class="relative">
                                    <button @click="open = !open"
                                        class="text-text-light hover:text-primary rounded-full p-2 focus:outline-none focus:ring-2 focus:ring-primary-light">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-transition
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right bg-surface rounded-xl shadow-medium ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        style="display: none;">
                                        <div class="py-1">
                                            @can('edit-pages')
                                                <a href="{{ route('dashboard.pages.edit', $page) }}" class="dropdown-item">
                                                    <i class="fas fa-edit w-5"></i> Edit
                                                </a>
                                            @endcan
                                            @can('delete-pages')
                                                <form action="{{ route('dashboard.pages.destroy', $page) }}" method="POST"
                                                    onsubmit="return confirm('Anda yakin ingin menghapus halaman ini secara permanen?');">
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
                            <td colspan="5" class="text-center p-10">
                                <div class="text-text-light">
                                    <i class="fas fa-file-alt fa-3x"></i>
                                    <p class="mt-4">Belum ada halaman statis yang dibuat.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($pages->hasPages())
            <div class="p-6 border-t border-border">
                {{ $pages->links() }}
            </div>
        @endif
    </div>
@endsection
