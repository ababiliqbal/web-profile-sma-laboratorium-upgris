{{-- Menampilkan Error Validasi --}}
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

<div class="bg-surface p-6 rounded-2xl shadow-soft">
    {{-- Nama Album --}}
    <div>
        <label for="name" class="form-label">Nama Album</label>
        <input type="text" id="name" name="name" value="{{ old('name', $album->name ?? '') }}"
            class="input-form" required>
        <p class="text-xs text-text-light mt-1">Contoh: "Kegiatan Class Meeting 2025", "Studi Tur ke Museum".</p>
    </div>

    {{-- Deskripsi Album --}}
    <div class="mt-4">
        <label for="description" class="form-label">Deskripsi Singkat (Opsional)</label>
        <textarea id="description" name="description" rows="4" class="input-form">{{ old('description', $album->description ?? '') }}</textarea>
    </div>
</div>

{{-- Tombol Aksi --}}
<div class="flex justify-end mt-6 gap-4">
    <a href="{{ route('dashboard.albums.index') }}" class="btn-secondary">Batal</a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i>
        <span>{{ $submitButtonText ?? 'Simpan' }}</span>
    </button>
</div>
