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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label">Nama Organisasi</label>
                    <input type="text" id="name" name="name"
                        value="{{ old('name', $studentOrganization->name ?? '') }}" class="input-form" required>
                </div>
                <div>
                    {{-- Perbaikan: Menggunakan supervisor_staff_id --}}
                    <label for="supervisor_staff_id" class="form-label">Guru Pembina (Opsional)</label>
                    <select id="supervisor_staff_id" name="supervisor_staff_id" class="input-form">
                        <option value="">-- Pilih Guru --</option>
                        @foreach ($teachers as $teacher)
                            {{-- Perbaikan: Menggunakan supervisor_staff_id --}}
                            <option value="{{ $teacher->id }}" @selected(old('supervisor_staff_id', $studentOrganization->supervisor_staff_id ?? '') == $teacher->id)>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <label for="description" class="form-label">Deskripsi Singkat</label>
                <textarea id="description" name="description" rows="5" class="input-form">{{ old('description', $studentOrganization->description ?? '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Logo & Aksi --}}
    <div class="space-y-6">
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Logo Organisasi</h4>
            <div x-data="{ imagePreview: '{{ isset($studentOrganization) && $studentOrganization->logo_path ? asset('storage/' . $studentOrganization->logo_path) : '' }}' }">
                <input type="file" id="logo" name="logo" class="hidden" x-ref="logo"
                    @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                <div x-show="imagePreview"
                    class="my-2 border border-dashed border-border rounded-xl p-2 flex justify-center">
                    <img :src="imagePreview" alt="Preview" class="h-32 object-contain">
                </div>
                <button type="button" @click="$refs.logo.click()" class="btn-secondary w-full mt-2">
                    <i class="fas fa-upload"></i>
                    <span>{{ isset($studentOrganization) && $studentOrganization->logo_path ? 'Ganti Logo' : 'Pilih Logo' }}</span>
                </button>
            </div>
            {{-- Tambahan: Input untuk image_alt --}}
            <div class="mt-4">
                <label for="image_alt" class="form-label">Teks Alternatif Logo (SEO)</label>
                <input type="text" id="image_alt" name="image_alt"
                    value="{{ old('image_alt', $studentOrganization->image_alt ?? '') }}" class="input-form">
            </div>
        </div>
        <div class="flex justify-end gap-4">
            {{-- Perbaikan: Menggunakan route yang benar --}}
            <a href="{{ route('dashboard.student-organizations.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary"><i
                    class="fas fa-save"></i><span>{{ $submitButtonText ?? 'Simpan' }}</span></button>
        </div>
    </div>
</div>
