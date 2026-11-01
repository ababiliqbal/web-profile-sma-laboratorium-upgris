@extends('layouts.app')

@section('title', 'Manajemen Agenda Akademik')

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
                <h3 class="text-xl font-bold text-text-dark">Daftar Agenda</h3>
                <div class="flex items-center gap-2">
                    <form action="{{ route('dashboard.academic-events.index') }}" method="GET">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-text-light"></i>
                            <input type="text" name="search" placeholder="Cari agenda..."
                                class="input-form pl-10 w-48 sm:w-64 !mt-0" value="{{ request('search') }}">
                        </div>
                    </form>

                    {{-- Perbaikan: Tombol dilindungi permission --}}
                    @can('manage-academic-events')
                        <a href="{{ route('dashboard.academic-events.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> <span class="hidden sm:inline">Tambah Agenda</span>
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-text-light">
                <thead class="text-xs text-text-light uppercase bg-background">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Agenda</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Tanggal Mulai</th>
                        <th scope="col" class="px-6 py-3">Tanggal Selesai</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr class="bg-surface border-b border-border hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-text-dark">{{ $event->title }}</td>
                            <td class="px-6 py-4">
                                {{-- Perbaikan: Menambahkan kategori 'holiday' dan default case --}}
                                @php
                                    $categoryClasses = [
                                        'academic' => 'text-blue-800 bg-blue-200',
                                        'ppdb' => 'text-green-800 bg-green-200',
                                        'event' => 'text-purple-800 bg-purple-200',
                                        'holiday' => 'text-red-800 bg-red-200',
                                    ];
                                    $class = $categoryClasses[$event->category] ?? 'text-gray-800 bg-gray-200';
                                @endphp
                                <span class="px-3 py-1 text-xs font-bold rounded-full {{ $class }}">
                                    {{ Str::ucfirst($event->category) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($event->start_date)->isoFormat('D MMMM YYYY') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->isoFormat('D MMMM YYYY') : '-' }}
                            </td>
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
                                            @can('manage-academic-events')
                                                <a href="{{ route('dashboard.academic-events.edit', $event) }}"
                                                    class="dropdown-item"><i class="fas fa-edit w-5"></i> Edit</a>
                                                <form action="{{ route('dashboard.academic-events.destroy', $event) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Anda yakin ingin menghapus agenda ini?');">
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
                                <div class="text-text-light"><i class="fas fa-calendar-times fa-3x"></i>
                                    <p class="mt-4">Tidak ada data agenda ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($events->hasPages())
            <div class="p-6 border-t border-border">
                {{ $events->links() }}
            </div>
        @endif
    </div>
@endsection
