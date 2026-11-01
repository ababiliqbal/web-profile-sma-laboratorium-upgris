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
    <div class="lg:col-span-2 space-y-8">
        {{-- Kartu untuk Judul --}}
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <label for="title" class="form-label">Judul Postingan</label>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title ?? '') }}"
                class="input-form text-lg font-semibold" required>
        </div>
        {{-- Kartu untuk Konten --}}
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <label for="content" class="form-label">Konten Utama</label>
            <div class="mt-2">
                <textarea id="content" name="content" rows="15" class="input-form">{{ old('content', $post->content ?? '') }}</textarea>
            </div>
        </div>
        {{-- Kartu untuk SEO --}}
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Pengaturan SEO (Opsional)</h4>
            <div class="space-y-4">
                <div>
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title"
                        value="{{ old('meta_title', $post->meta_title ?? '') }}" class="input-form">
                </div>
                <div>
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="3" class="input-form">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Pengaturan & Gambar --}}
    <div class="space-y-8">
        {{-- Kartu untuk Pengaturan Publikasi --}}
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Publikasi</h4>
            <div class="space-y-4">
                <div>
                    <label for="category_id" class="form-label">Kategori</label>
                    <select id="category_id" name="category_id" class="input-form" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id ?? '') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    {{-- Tambahan: Input untuk Tags --}}
                    <label for="tags" class="form-label">Tags (Opsional)</label>
                    <select id="tags" name="tags[]" class="input-form" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" @if (isset($post) && $post->tags->contains($tag->id)) selected @endif
                                @if (is_array(old('tags')) && in_array($tag->id, old('tags'))) selected @endif>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-text-light mt-1">Bisa pilih lebih dari satu.</p>
                </div>
                <div>
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="input-form" required>
                        <option value="draft" @selected(old('status', $post->status ?? 'draft') == 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $post->status ?? '') == 'published')>Published</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- Kartu untuk Gambar Unggulan --}}
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Gambar Unggulan</h4>
            <div class="mt-2">
                <div x-data="{ imagePreview: '{{ isset($post) && $post->image_path ? asset('storage/' . $post->image_path) : '' }}' }">
                    <input type="file" id="image" name="image" class="hidden" x-ref="image"
                        @change="imagePreview = URL.createObjectURL($event.target.files[0])">

                    <div x-show="imagePreview" class="mb-4 border border-dashed border-border rounded-xl p-2">
                        <img :src="imagePreview" alt="Preview Gambar" class="w-full h-40 object-cover rounded-lg">
                    </div>

                    <button type="button" @click="$refs.image.click()" class="btn-secondary w-full">
                        <i class="fas fa-upload"></i>
                        <span>{{ isset($post) && $post->image_path ? 'Ganti Gambar' : 'Pilih Gambar' }}</span>
                    </button>
                </div>
            </div>
            <div class="mt-4">
                <label for="image_alt" class="form-label">Teks Alternatif Gambar</label>
                <input type="text" id="image_alt" name="image_alt"
                    value="{{ old('image_alt', $post->image_alt ?? '') }}" class="input-form">
                <p class="text-xs text-text-light mt-1">Deskripsi singkat gambar untuk SEO.</p>
            </div>
        </div>
        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-4">
            <a href="{{ route('dashboard.posts.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                <span>{{ $submitButtonText ?? 'Simpan' }}</span>
            </button>
        </div>
    </div>
</div>
