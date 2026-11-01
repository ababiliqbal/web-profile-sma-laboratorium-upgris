<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Menghapus dokumen dari database dan file dari storage.
     */
    public function destroy(Document $document)
    {
        // Otorisasi bisa lebih spesifik di sini jika perlu.
        // Contoh: $this->authorize('delete', $document->documentable);
        $this->authorize('manage-academic-events'); // Gunakan permission induk sementara

        // Hapus file fisik dari storage
        Storage::disk('public')->delete($document->file_path);

        // Hapus record dari database
        $document->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }

    public function download(Document $document)
    {
        // 1. Tambah jumlah unduhan
        // method increment() lebih efisien daripada $document->downloads++
        $document->increment('downloads');

        // 2. Dapatkan path lengkap ke file di storage
        $filePath = storage_path('app/public/' . $document->file_path);

        // 3. Cek apakah file benar-benar ada untuk menghindari error
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        // 4. Kirim file ke browser untuk diunduh
        // Nama file yang akan diunduh oleh pengguna diambil dari judul di database
        return response()->download($filePath, $document->title);
    }
}
