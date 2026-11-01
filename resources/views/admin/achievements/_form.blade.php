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
                <label for="title" class="form-label">Nama Prestasi / Lomba</label>
                <input type="text" id="title" name="title" value="{{ old('title', $achievement->title ?? '') }}"
                    class="input-form" required>
            </div>
            <div class="mt-4">
                <label for="description" class="form-label">Deskripsi Singkat (Opsional)</label>
                <textarea id="description" name="description" rows="5" class="input-form">{{ old('description', $achievement->description ?? '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Pengaturan & Gambar --}}
    <div class="space-y-6">
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Detail Prestasi</h4>
            <div class="space-y-4">
                <div>
                    <label for="date" class="form-label">Tanggal Diraih</label>
                    <input type="date" id="date" name="date"
                        value="{{ old('date', isset($achievement) ? $achievement->date->format('Y-m-d') : '') }}"
                        class="input-form" required>
                </div>
                <div>
                    <label for="level" class="form-label">Tingkat Prestasi</label>
                    <select id="level" name="level" class="input-form" required>
                        <option value="">Pilih Tingkat</option>
                        <option value="school" @selected(old('level', $achievement->level ?? '') == 'school')>Sekolah</option>
                        <option value="city" @selected(old('level', $achievement->level ?? '') == 'city')>Kota/Kabupaten</option>
                        {{-- Perbaikan: Menambahkan tingkat 'province' --}}
                        <option value="province" @selected(old('level', $achievement->level ?? '') == 'province')>Provinsi</option>
                        <option value="national" @selected(old('level', $achievement->level ?? '') == 'national')>Nasional</option>
                        <option value="international" @selected(old('level', $achievement->level ?? '') == 'international')>Internasional</option>
                    </select>
                </div>
                <div>
                    <label for="type" class="form-label">Tipe Prestasi</label>
                    <select id="type" name="type" class="input-form" required>
                        <option value="">Pilih Tipe</option>
                        <option value="school" @selected(old('type', $achievement->type ?? '') == 'school')>Sekolah</option>
                        <option value="student" @selected(old('type', $achievement->type ?? '') == 'student')>Siswa</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Foto / Sertifikat</h4>
            <div x-data="{ imagePreview: '{{ isset($achievement) && $achievement->image_path ? asset('storage/' . $achievement->image_path) : '' }}' }">
                <input type="file" id="image" name="image" class="hidden" x-ref="image"
                    @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                <div x-show="imagePreview" class="my-2 border border-dashed border-border rounded-xl p-2"><img
                        :src="imagePreview" alt="Preview" class="w-full h-40 object-cover rounded-lg"></div>
                <button type="button" @click="$refs.image.click()" class="btn-secondary w-full mt-2"><i
                        class="fas fa-upload"></i><span>{{ isset($achievement) && $achievement->image_path ? 'Ganti Foto' : 'Pilih Foto' }}</span></button>
            </div>
            {{-- Tambahan: Input untuk image_alt --}}
            <div class="mt-4">
                <label for="image_alt" class="form-label">Teks Alternatif Foto (SEO)</label>
                <input type="text" id="image_alt" name="image_alt"
                    value="{{ old('image_alt', $achievement->image_alt ?? '') }}" class="input-form">
            </div>
        </div>
        <div class="flex justify-end gap-4">
            {{-- Perbaikan: Menggunakan route yang benar --}}
            <a href="{{ route('dashboard.achievements.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary"><i
                    class="fas fa-save"></i><span>{{ $submitButtonText ?? 'Simpan' }}</span></button>
        </div>
    </div>
</div>
