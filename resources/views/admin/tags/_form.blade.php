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
    {{-- Nama Tag --}}
    <div>
        <label for="name" class="form-label">Nama Tag</label>
        <input type="text" id="name" name="name" value="{{ old('name', $tag->name ?? '') }}" class="input-form"
            required>
        <p class="text-xs text-text-light mt-1">Slug akan dibuat secara otomatis dari nama tag.</p>
    </div>
</div>

{{-- Tombol Aksi --}}
<div class="flex justify-end mt-6 gap-4">
    <a href="{{ route('dashboard.tags.index') }}" class="btn-secondary">Batal</a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i>
        <span>{{ $submitButtonText ?? 'Simpan' }}</span>
    </button>
</div>
