@extends('layouts.app')

@section('title', 'Kotak Masuk')

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
                <h3 class="text-xl font-bold text-text-dark">Kotak Masuk Pesan</h3>
                <div class="flex items-center gap-2">
                    <form action="{{ route('dashboard.contact-messages.index') }}" method="GET">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-text-light"></i>
                            <input type="text" name="search" placeholder="Cari pesan..."
                                class="input-form pl-10 w-48 sm:w-64 !mt-0" value="{{ request('search') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-text-light">
                <thead class="text-xs text-text-light uppercase bg-background">
                    <tr>
                        <th scope="col" class="px-6 py-3">Pengirim</th>
                        <th scope="col" class="px-6 py-3">Subjek</th>
                        <th scope="col" class="px-6 py-3">Tanggal Diterima</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $message)
                        {{-- Tambahkan class 'font-bold' dan 'bg-primary-light/30' jika pesan belum dibaca --}}
                        <tr
                            class="bg-surface border-b border-border hover:bg-gray-50 {{ !$message->is_read ? 'bg-primary-light/30 font-bold' : '' }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-3 h-3 rounded-full {{ !$message->is_read ? 'bg-primary' : 'bg-transparent' }}">
                                    </div>
                                    <div>
                                        <div class="text-text-dark">{{ $message->name }}</div>
                                        <div
                                            class="text-xs {{ !$message->is_read ? 'text-text-dark' : 'text-text-light' }}">
                                            {{ $message->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('dashboard.contact-messages.show', $message) }}"
                                    class="hover:text-primary hover:underline text-text-dark">
                                    {{ Str::limit($message->subject ?? 'Tanpa Subjek', 40) }}
                                </a>
                            </td>
                            <td class="px-6 py-4">{{ $message->created_at->isoFormat('D MMMM YYYY, HH:mm') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    @can('view-contact-messages')
                                        <a href="{{ route('dashboard.contact-messages.show', $message) }}"
                                            class="text-primary hover:text-primary-dark" title="Lihat Pesan">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan
                                    @can('delete-contact-messages')
                                        <form action="{{ route('dashboard.contact-messages.destroy', $message) }}"
                                            method="POST"
                                            onsubmit="return confirm('Anda yakin ingin menghapus pesan ini secara permanen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger hover:text-red-700" title="Hapus Pesan">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-10">
                                <div class="text-text-light">
                                    <i class="fas fa-inbox fa-3x"></i>
                                    <p class="mt-4">Tidak ada pesan masuk.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($messages->hasPages())
            <div class="p-6 border-t border-border">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
@endsection
