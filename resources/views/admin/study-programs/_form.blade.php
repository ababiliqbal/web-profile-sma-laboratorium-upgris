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
    {{-- Kolom Kiri: Form Utama --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <div>
                <label for="name" class="form-label">Nama Program Studi / Jurusan</label>
                <input type="text" id="name" name="name" value="{{ old('name', $studyProgram->name ?? '') }}"
                    class="input-form" required>
            </div>
            <div class="mt-4">
                <label for="description" class="form-label">Deskripsi Jurusan</label>
                <textarea id="description" name="description" rows="8" class="input-form">{{ old('description', $studyProgram->description ?? '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Pengaturan & Gambar --}}
    <div class="space-y-6">
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Pengaturan Jurusan</h4>
            <div>
                {{-- Perbaikan: Menggunakan head_staff_id dan variabel $teachers --}}
                <label for="head_staff_id" class="form-label">Kepala Jurusan (Opsional)</label>
                <select id="head_staff_id" name="head_staff_id" class="input-form">
                    <option value="">-- Pilih Guru --</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" @selected(old('head_staff_id', $studyProgram->head_staff_id ?? '') == $teacher->id)>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Gambar Jurusan</h4>
            <div x-data="{ imagePreview: '{{ isset($studyProgram) && $studyProgram->image_path ? asset('storage/' . $studyProgram->image_path) : '' }}' }">
                <input type="file" id="image" name="image" class="hidden" x-ref="image"
                    @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                <div x-show="imagePreview" class="my-2 border border-dashed border-border rounded-xl p-2">
                    <img :src="imagePreview" alt="Preview" class="w-full h-40 object-cover rounded-lg">
                </div>
                <button type="button" @click="$refs.image.click()" class="btn-secondary w-full mt-2">
                    <i class="fas fa-upload"></i>
                    <span>{{ isset($studyProgram) && $studyProgram->image_path ? 'Ganti Gambar' : 'Pilih Gambar' }}</span>
                </button>
            </div>
            {{-- Tambahan: Input untuk image_alt --}}
            <div class="mt-4">
                <label for="image_alt" class="form-label">Teks Alternatif Gambar (SEO)</label>
                <input type="text" id="image_alt" name="image_alt"
                    value="{{ old('image_alt', $studyProgram->image_alt ?? '') }}" class="input-form">
            </div>
        </div>
        <div class="flex justify-end gap-4">
            <a href="{{ route('dashboard.study-programs.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                <span>{{ $submitButtonText ?? 'Simpan' }}</span>
            </button>
        </div>
    </div>
</div>
