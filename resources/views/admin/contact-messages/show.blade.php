@extends('layouts.app')

@section('title', 'Detail Pesan Masuk')

@section('content')
    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
        {{-- Tombol Kembali --}}
        <a href="{{ route('dashboard.contact-messages.index') }}"
            class="flex items-center text-sm text-text-light hover:text-primary transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Kotak Masuk
        </a>

        {{-- Tombol Hapus --}}
        @can('delete-contact-messages')
            <form action="{{ route('dashboard.contact-messages.destroy', $contactMessage) }}" method="POST"
                onsubmit="return confirm('Anda yakin ingin menghapus pesan ini secara permanen?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-secondary !bg-red-100 !text-danger hover:!bg-red-200">
                    <i class="fas fa-trash-alt"></i>
                    <span>Hapus Pesan Ini</span>
                </button>
            </form>
        @endcan
    </div>

    <div class="bg-surface rounded-2xl shadow-soft">
        {{-- Header Pesan --}}
        <div class="p-6 border-b border-border">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-primary-light rounded-full flex items-center justify-center text-primary text-xl">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-text-dark">{{ $contactMessage->name }}</h3>
                    <p class="text-sm text-text-light">
                        <a href="mailto:{{ $contactMessage->email }}"
                            class="hover:underline">{{ $contactMessage->email }}</a>
                    </p>
                    <p class="text-xs text-text-light mt-1">
                        Diterima pada: {{ $contactMessage->created_at->isoFormat('dddd, D MMMM YYYY - HH:mm') }}
                    </p>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-xl font-semibold text-text-dark">{{ $contactMessage->subject ?? 'Tanpa Subjek' }}</p>
            </div>
        </div>

        {{-- Isi Pesan --}}
        <div class="p-6">
            <p class="text-text whitespace-pre-wrap leading-relaxed">
                {{ $contactMessage->message }}
            </p>
        </div>
    </div>
@endsection
