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
                    <label for="name" class="form-label">Nama Alumni</label>
                    <input type="text" id="name" name="name"
                        value="{{ old('name', $alumniTestimonial->name ?? '') }}" class="input-form" required>
                </div>
                <div>
                    <label for="graduation_year" class="form-label">Tahun Lulus</label>
                    <input type="number" id="graduation_year" name="graduation_year"
                        value="{{ old('graduation_year', $alumniTestimonial->graduation_year ?? '') }}"
                        class="input-form" placeholder="Contoh: 2019">
                </div>
            </div>
            <div class="mt-4">
                <label for="current_occupation" class="form-label">Pekerjaan / Aktivitas Saat Ini</label>
                <input type="text" id="current_occupation" name="current_occupation"
                    value="{{ old('current_occupation', $alumniTestimonial->current_occupation ?? '') }}"
                    class="input-form">
            </div>
            <div class="mt-4">
                <label for="testimonial" class="form-label">Isi Testimoni</label>
                <textarea id="testimonial" name="testimonial" rows="6" class="input-form" required>{{ old('testimonial', $alumniTestimonial->testimonial ?? '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Foto & Aksi --}}
    <div class="space-y-6">
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Foto Alumni</h4>
            <div x-data="{ imagePreview: '{{ isset($alumniTestimonial) && $alumniTestimonial->image_path ? asset('storage/' . $alumniTestimonial->image_path) : '' }}' }">
                <input type="file" id="image" name="image" class="hidden" x-ref="image"
                    @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                <div x-show="imagePreview" class="my-2 flex justify-center">
                    <img :src="imagePreview" alt="Preview" class="w-32 h-32 object-cover rounded-full">
                </div>
                <button type="button" @click="$refs.image.click()" class="btn-secondary w-full mt-2">
                    <i class="fas fa-upload"></i>
                    <span>{{ isset($alumniTestimonial) && $alumniTestimonial->image_path ? 'Ganti Foto' : 'Pilih Foto' }}</span>
                </button>
            </div>
            {{-- Tambahan: Input untuk image_alt --}}
            <div class="mt-4">
                <label for="image_alt" class="form-label">Teks Alternatif Foto (SEO)</label>
                <input type="text" id="image_alt" name="image_alt"
                    value="{{ old('image_alt', $alumniTestimonial->image_alt ?? '') }}" class="input-form">
            </div>
        </div>
        <div class="flex justify-end gap-4">
            {{-- Perbaikan: Menggunakan route yang benar --}}
            <a href="{{ route('dashboard.alumni-testimonials.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary"><i
                    class="fas fa-save"></i><span>{{ $submitButtonText ?? 'Simpan' }}</span></button>
        </div>
    </div>
</div>
