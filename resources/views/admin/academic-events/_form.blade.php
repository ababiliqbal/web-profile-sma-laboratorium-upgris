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
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <label for="title" class="form-label">Judul Agenda</label>
            <input type="text" id="title" name="title" value="{{ old('title', $academicEvent->title ?? '') }}"
                class="input-form" required>
        </div>
        <div>
            <label for="start_date" class="form-label">Tanggal Mulai</label>
            <input type="date" id="start_date" name="start_date"
                value="{{ old('start_date', isset($academicEvent) ? $academicEvent->start_date->format('Y-m-d') : '') }}"
                class="input-form" required>
        </div>
        <div>
            <label for="end_date" class="form-label">Tanggal Selesai (Opsional)</label>
            <input type="date" id="end_date" name="end_date"
                value="{{ old('end_date', isset($academicEvent) && $academicEvent->end_date ? $academicEvent->end_date->format('Y-m-d') : '') }}"
                class="input-form">
        </div>
        <div class="md:col-span-2">
            <label for="category" class="form-label">Kategori</label>
            <select id="category" name="category" class="input-form" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="academic" @selected(old('category', $academicEvent->category ?? '') == 'academic')>Akademik</option>
                <option value="ppdb" @selected(old('category', $academicEvent->category ?? '') == 'ppdb')>PPDB</option>
                <option value="event" @selected(old('category', $academicEvent->category ?? '') == 'event')>Acara Umum</option>
                {{-- Perbaikan: Menambahkan kategori 'holiday' --}}
                <option value="holiday" @selected(old('category', $academicEvent->category ?? '') == 'holiday')>Libur</option>
            </select>
        </div>
        <div class="md:col-span-2">
            <label for="description" class="form-label">Deskripsi (Opsional)</label>
            <textarea id="description" name="description" rows="5" class="input-form">{{ old('description', $academicEvent->description ?? '') }}</textarea>
        </div>
    </div>

    {{-- (BARU) Bagian untuk mengelola Dokumen Lampiran --}}
    {{-- Hanya tampil di halaman edit --}}
    @if (isset($academicEvent))
        <div class="bg-surface p-6 rounded-2xl shadow-soft mt-8">
            <h4 class="font-bold text-text-dark mb-4 border-b border-border pb-2">Dokumen Terlampir</h4>

            <ul class="space-y-2 mb-6">
                @forelse($academicEvent->documents as $document)
                    <li class="flex justify-between items-center py-2 border-b border-border text-sm">
                        {{-- Link untuk melihat/preview file di tab baru --}}
                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                            class="text-primary hover:underline flex items-center gap-2">
                            <i class="fas fa-file-alt"></i>
                            <span>{{ $document->title }}</span>
                        </a>

                        {{-- Grup tombol aksi (Download & Hapus) --}}
                        <div class="flex items-center gap-4">
                            {{-- (BARU) Tombol untuk mengunduh file --}}
                            <a href="{{ route('documents.download', $document) }}"
                                class="text-green-600 hover:text-green-800 text-xs font-bold flex items-center gap-1"
                                title="Unduh file ini">
                                <i class="fas fa-download"></i>
                                <span>UNDUH ({{ $document->downloads }})</span>
                            </a>

                            @can('manage-academic-events')
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

            @can('manage-academic-events')
                <div>
                    <label for="documents" class="form-label">Tambah Dokumen Baru</label>
                    <input type="file" name="documents[]" id="documents" multiple
                        class="input-form file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-light file:text-primary hover:file:bg-blue-200">
                </div>
            @endcan
        </div>
    @endif

    <div class="flex justify-end mt-6 gap-4">
        {{-- Perbaikan: Menggunakan route yang benar --}}
        <a href="{{ route('dashboard.academic-events.index') }}" class="btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary"><i
                class="fas fa-save"></i><span>{{ $submitButtonText ?? 'Simpan' }}</span></button>
    </div>
</div>
