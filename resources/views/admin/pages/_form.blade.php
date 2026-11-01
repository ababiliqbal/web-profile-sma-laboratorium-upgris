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
        {{-- Judul Halaman --}}
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <div>
                <label for="title" class="form-label">Judul Halaman</label>
                <input type="text" id="title" name="title" value="{{ old('title', $page->title ?? '') }}"
                    class="input-form text-lg font-semibold" required>
                <p class="text-xs text-text-light mt-1">Contoh: "Sejarah Sekolah", "Visi & Misi", "Kontak Kami".</p>
            </div>
        </div>

        {{-- Konten Halaman --}}
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <label for="content" class="form-label">Konten Halaman</label>
            <div class="mt-2">
                <textarea id="content" name="content" rows="20" class="input-form">{{ old('content', $page->content ?? '') }}</textarea>
            </div>
        </div>

        {{-- Pengaturan SEO --}}
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Pengaturan SEO (Opsional)</h4>
            <div class="space-y-4">
                <div>
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title"
                        value="{{ old('meta_title', $page->meta_title ?? '') }}" class="input-form">
                    <p class="text-xs text-text-light mt-1">Judul yang akan tampil di tab browser dan hasil pencarian
                        Google.</p>
                </div>
                <div>
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="3" class="input-form">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
                    <p class="text-xs text-text-light mt-1">Deskripsi singkat (sekitar 160 karakter) untuk hasil
                        pencarian Google.</p>
                </div>
            </div>
        </div>

        {{-- (BARU) Bagian untuk mengelola Dokumen Lampiran --}}
        {{-- Hanya tampil di halaman edit --}}
        @if (isset($page))
            <div class="bg-surface p-6 rounded-2xl shadow-soft">
                <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Dokumen Terlampir</h4>
                <ul class="space-y-2 mb-6">
                    @forelse($page->documents as $document)
                        <li class="flex justify-between items-center py-2 border-b border-border text-sm">
                            <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                                class="text-primary hover:underline flex items-center gap-2">
                                <i class="fas fa-file-alt"></i>
                                <span>{{ $document->title }}</span>
                            </a>
                            <div class="flex items-center gap-4">
                                <a href="{{ route('documents.download', $document) }}"
                                    class="text-green-600 hover:text-green-800 text-xs font-bold flex items-center gap-1"
                                    title="Unduh file ini">
                                    <i class="fas fa-download"></i>
                                    <span>UNDUH ({{ $document->downloads }})</span>
                                </a>
                                @can('manage-pages')
                                    <button type="button"
                                        @click="confirmDelete('{{ route('dashboard.documents.destroy', $document) }}')"
                                        class="text-danger hover:text-red-700 text-xs font-bold">
                                        HAPUS
                                    </button>
                                @endcan
                            </div>
                        </li>
                    @empty
                        <p class="text-text-light text-sm italic">Tidak ada dokumen terlampir.</p>
                    @endforelse
                </ul>

                @can('manage-pages')
                    <div>
                        <label for="documents" class="form-label">Tambah Dokumen Baru</label>
                        <input type="file" name="documents[]" id="documents" multiple
                            class="input-form file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-blue-200">
                    </div>
                @endcan
            </div>
        @endif
    </div>

    {{-- Kolom Kanan: Pengaturan & Aksi --}}
    <div class="space-y-6">
        {{-- Status Publikasi --}}
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Status</h4>
            <div>
                <label for="status" class="form-label">Status Publikasi</label>
                <select name="status" id="status" class="input-form" required>
                    <option value="published" @selected(old('status', $page->status ?? '') == 'published')>Diterbitkan (Published)</option>
                    <option value="draft" @selected(old('status', $page->status ?? '') == 'draft')>Draf (Draft)</option>
                </select>
                <p class="text-xs text-text-light mt-2">"Draf" akan menyimpan halaman tanpa menampilkannya ke publik.
                </p>
            </div>
        </div>

        {{-- Gambar Header --}}
        <div class="bg-surface p-6 rounded-2xl shadow-soft">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Gambar Header</h4>
            <div x-data="{ imagePreview: '{{ isset($page) && $page->image_path ? asset('storage/' . $page->image_path) : '' }}' }">
                <input type="file" id="image" name="image" class="hidden" x-ref="image"
                    @change="imagePreview = URL.createObjectURL($event.target.files[0])">

                <div x-show="imagePreview" class="my-2 border border-dashed border-border rounded-xl p-2">
                    <img :src="imagePreview" alt="Preview" class="w-full h-40 object-cover rounded-lg">
                </div>

                <button type="button" @click="$refs.image.click()" class="btn-secondary w-full mt-2">
                    <i class="fas fa-upload"></i>
                    <span>{{ isset($page) && $page->image_path ? 'Ganti Gambar' : 'Pilih Gambar' }}</span>
                </button>
                <p class="text-xs text-text-light mt-2">Opsional. Gambar ini bisa ditampilkan di bagian atas halaman.
                </p>
            </div>
            <div class="mt-4">
                <label for="image_alt" class="form-label">Teks Alternatif Gambar</label>
                <input type="text" id="image_alt" name="image_alt"
                    value="{{ old('image_alt', $page->image_alt ?? '') }}" class="input-form">
                <p class="text-xs text-text-light mt-1">Deskripsi singkat gambar untuk SEO dan aksesibilitas.</p>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-4">
            <a href="{{ route('dashboard.pages.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                <span>{{ $submitButtonText ?? 'Simpan' }}</span>
            </button>
        </div>
    </div>
</div>
