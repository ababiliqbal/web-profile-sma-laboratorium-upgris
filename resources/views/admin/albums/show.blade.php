@extends('layouts.app')

@section('title', 'Kelola Album: ' . $album->name)

@section('content')
    {{-- Tombol Kembali --}}
    <div class="mb-6">
        <a href="{{ route('dashboard.albums.index') }}"
            class="flex items-center text-sm text-text-light hover:text-primary transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Album
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
            class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-r-lg shadow-soft" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-r-lg" role="alert">
            <p class="font-bold">Terjadi Kesalahan</p>
            <ul class="list-disc pl-5 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kolom Kiri: Form Upload Foto --}}
        <div class="lg:col-span-1">
            <div class="bg-surface p-6 rounded-2xl shadow-soft sticky top-8">
                <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Unggah Foto Baru</h4>
                <p class="text-sm text-text-light mb-4">Album: <span
                        class="font-semibold text-text-dark">{{ $album->name }}</span></p>

                @can('manage-galleries')
                    <form action="{{ route('dashboard.photos.store', $album) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="photos" class="form-label">Pilih Foto (bisa lebih dari satu)</label>
                        <input type="file" id="photos" name="photos[]" multiple
                            class="input-form file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-blue-200"
                            required>
                        <button type="submit" class="btn btn-primary w-full mt-4">
                            <i class="fas fa-upload"></i> Unggah Foto
                        </button>
                    </form>
                @endcan
            </div>
        </div>

        {{-- Kolom Kanan: Galeri Foto yang Ada --}}
        <div class="lg:col-span-2 bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4">Daftar Foto ({{ $album->photos->count() }})</h4>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @forelse($album->photos as $photo)
                    <div class="relative group" x-data="{ open: false }">
                        <img src="{{ asset('storage/' . $photo->image_path) }}"
                            alt="{{ $photo->image_alt ?? 'Foto dari album ' . $album->name }}"
                            class="w-full h-32 object-cover rounded-lg">

                        @can('manage-galleries')
                            <div
                                class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center gap-4">
                                {{-- Tombol Edit --}}
                                <button @click="open = true" class="text-white text-xl hover:text-primary transition-colors"><i
                                        class="fas fa-edit"></i></button>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('dashboard.photos.destroy', $photo) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus foto ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white text-xl hover:text-danger transition-colors"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        @endcan

                        {{-- Modal untuk Edit Detail Foto --}}
                        <div x-show="open" @click.away="open = false"
                            class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
                            style="display: none;">
                            <div class="bg-surface rounded-2xl shadow-soft p-6 w-full max-w-md">
                                <h5 class="font-bold text-text-dark text-lg mb-4">Edit Detail Foto</h5>
                                <form action="{{ route('dashboard.photos.update', $photo) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="space-y-4">
                                        <div>
                                            <label for="title-{{ $photo->id }}" class="form-label">Judul Foto
                                                (Opsional)
                                            </label>
                                            <input type="text" id="title-{{ $photo->id }}" name="title"
                                                value="{{ old('title', $photo->title) }}" class="input-form">
                                        </div>
                                        <div>
                                            <label for="description-{{ $photo->id }}" class="form-label">Deskripsi
                                                (Opsional)</label>
                                            <textarea id="description-{{ $photo->id }}" name="description" rows="3" class="input-form">{{ old('description', $photo->description) }}</textarea>
                                        </div>
                                        <div>
                                            <label for="image_alt-{{ $photo->id }}" class="form-label">Teks Alternatif
                                                (SEO)</label>
                                            <input type="text" id="image_alt-{{ $photo->id }}" name="image_alt"
                                                value="{{ old('image_alt', $photo->image_alt) }}" class="input-form">
                                        </div>
                                        <div class="flex justify-end gap-4 pt-4">
                                            <button type="button" @click="open = false"
                                                class="btn-secondary">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-text-light py-10">Belum ada foto di album ini. Silakan unggah
                        foto baru.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
