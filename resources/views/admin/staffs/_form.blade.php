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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Kolom Kiri: Form Utama --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Informasi Utama</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $staff->name ?? '') }}"
                        class="input-form" required>
                </div>
                <div>
                    <label for="position" class="form-label">Jabatan</label>
                    <input type="text" id="position" name="position"
                        value="{{ old('position', $staff->position ?? '') }}" class="input-form" required>
                </div>
                <div>
                    <label for="identity_number" class="form-label">NIP / NUPTK (Opsional)</label>
                    <input type="text" id="identity_number" name="identity_number"
                        value="{{ old('identity_number', $staff->identity_number ?? '') }}" class="input-form">
                </div>
                <div>
                    <label for="email" class="form-label">Email (Opsional)</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $staff->email ?? '') }}"
                        class="input-form">
                </div>
                <div>
                    <label for="type" class="form-label">Tipe Personil</label>
                    <select name="type" id="type" class="input-form" required>
                        <option value="teacher" @selected(old('type', $staff->type ?? '') == 'teacher')>Guru</option>
                        <option value="staff" @selected(old('type', $staff->type ?? '') == 'staff')>Karyawan</option>
                    </select>
                </div>
                <div>
                    <label for="employment_status" class="form-label">Status Kepegawaian</label>
                    <select name="employment_status" id="employment_status" class="input-form" required>
                        <option value="pns" @selected(old('employment_status', $staff->employment_status ?? '') == 'pns')>PNS</option>
                        <option value="pppk" @selected(old('employment_status', $staff->employment_status ?? '') == 'pppk')>PPPK</option>
                        <option value="tetap_yayasan" @selected(old('employment_status', $staff->employment_status ?? '') == 'tetap_yayasan')>Tetap Yayasan</option>
                        <option value="honorer" @selected(old('employment_status', $staff->employment_status ?? '') == 'honorer')>Honorer</option>
                    </select>
                </div>
            </div>

            {{-- Input Mata Pelajaran (hanya untuk Guru) --}}
            <div class="mt-6" id="subjects-container">
                <label for="subjects" class="form-label">Mata Pelajaran yang Diampu</label>
                <select id="subjects" name="subjects[]" class="input-form" multiple>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" @if (isset($staff) && $staff->subjects->contains($subject->id)) selected @endif
                            @if (is_array(old('subjects')) && in_array($subject->id, old('subjects'))) selected @endif>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-text-light mt-1">Hanya diisi untuk tipe personil "Guru".</p>
            </div>

            <div class="mt-6">
                <label for="biography" class="form-label">Biografi Singkat (Opsional)</label>
                <textarea id="biography" name="biography" rows="5" class="input-form">{{ old('biography', $staff->biography ?? '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Pengaturan & Foto --}}
    <div class="space-y-6">
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Pengaturan & Foto</h4>
            <div>
                <label for="display_order" class="form-label">Urutan Tampil</label>
                <input type="number" id="display_order" name="display_order"
                    value="{{ old('display_order', $staff->display_order ?? '99') }}" class="input-form">
                <p class="text-xs text-text-light mt-1">Angka lebih kecil akan tampil lebih dulu.</p>
            </div>
            <div class="mt-4">
                <label for="image" class="form-label">Foto Profil</label>
                <div x-data="{ imagePreview: '{{ isset($staff) && $staff->image_path ? asset('storage/' . $staff->image_path) : '' }}' }">
                    <input type="file" id="image" name="image" class="hidden" x-ref="image"
                        @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                    <div x-show="imagePreview" class="my-2">
                        <img :src="imagePreview" alt="Preview Foto Profil"
                            class="w-32 h-32 object-cover rounded-full mx-auto">
                    </div>
                    <button type="button" @click="$refs.image.click()" class="btn-secondary w-full mt-2">
                        <i class="fas fa-upload"></i>
                        <span>{{ isset($staff) && $staff->image_path ? 'Ganti Foto' : 'Pilih Foto' }}</span>
                    </button>
                </div>
            </div>
            <div class="mt-4">
                <label for="image_alt" class="form-label">Teks Alternatif Foto</label>
                <input type="text" id="image_alt" name="image_alt"
                    value="{{ old('image_alt', $staff->image_alt ?? '') }}" class="input-form">
                <p class="text-xs text-text-light mt-1">Deskripsi singkat foto untuk SEO.</p>
            </div>
        </div>
        <div class="flex justify-end gap-4">
            <a href="{{ route('dashboard.staffs.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                <span>{{ $submitButtonText ?? 'Simpan' }}</span>
            </button>
        </div>
    </div>
</div>
