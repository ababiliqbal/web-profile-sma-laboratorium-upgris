@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-r-lg" role="alert">
        <p class="font-bold">Terjadi Kesalahan Validasi</p>
        <ul class="list-disc pl-5 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@csrf
<div class="bg-surface p-6 rounded-2xl shadow-soft">
    {{-- Nama Kelas --}}
    <div class="mb-6">
        <label for="name" class="form-label">Nama Kelas</label>
        <input type="text" id="name" name="name" value="{{ old('name', $class->name ?? '') }}"
            class="input-form @error('name') border-red-500 @enderror" required>
        @error('name')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Deskripsi --}}
    <div>
        <label for="description" class="form-label">Deskripsi (Opsional)</label>
        <textarea id="description" name="description" class="input-form @error('description') border-red-500 @enderror"
            rows="4">{{ old('description', $class->description ?? '') }}</textarea>
        @error('description')
            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- Tombol Aksi --}}
<div class="flex justify-end mt-6 gap-4">
    <a href="{{ route('classes.index') }}" class="btn-secondary">Batal</a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save mr-2"></i>
        <span>{{ $submitButtonText ?? 'Simpan' }}</span>
    </button>
</div>
