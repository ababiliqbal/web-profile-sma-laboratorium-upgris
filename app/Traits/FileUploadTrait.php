<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    /**
     * Menangani upload banyak file untuk relasi polimorfik.
     *
     * @param Request $request Request yang masuk.
     * @param Model $model Record model induk (contoh: $academicEvent).
     * @param string $requestKey Kunci dari input file di request (contoh: 'documents').
     * @param string $directory Direktori untuk menyimpan file di storage.
     * @return void
     */
    public function handleMultipleFileUploads(Request $request, Model $model, string $requestKey, string $directory): void
    {
        if ($request->hasFile($requestKey)) {
            foreach ($request->file($requestKey) as $file) {
                // Simpan file ke storage, buat subfolder berdasarkan ID model induk untuk kerapian
                $path = $file->store($directory . '/' . $model->id, 'public');

                // Buat record di tabel 'documents' yang terhubung ke model induk
                $model->documents()->create([
                    'title'     => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }
    }

    /**
     * Menangani upload satu file (contoh: gambar unggulan).
     *
     * @param Request $request
     * @param string $requestKey
     * @param Model $model
     * @param string $directory
     * @param string $field Nama kolom di database untuk path file.
     * @return void
     */
    public function handleSingleFileUpload(Request $request, string $requestKey, Model $model, string $directory, string $field = 'image_path'): void
    {
        if ($request->hasFile($requestKey)) {
            // Hapus file lama jika ada
            if ($model->{$field}) {
                Storage::disk('public')->delete($model->{$field});
            }

            // Simpan file baru dan update path di model
            $path = $request->file($requestKey)->store($directory, 'public');
            $model->update([$field => $path]);
        }
    }
}
