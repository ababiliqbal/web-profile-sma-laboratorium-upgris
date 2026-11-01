<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    // Method store menerima Album sebagai parameter untuk mengetahui di mana foto akan disimpan
    public function store(StorePhotoRequest $request, Album $album)
    {
        $this->authorize('manage-galleries');

        foreach ($request->file('photos') as $file) {
            $path = $file->store('photos/' . $album->id, 'public'); // Simpan dalam subfolder album
            $album->photos()->create(['image_path' => $path]);
        }

        return back()->with('success', 'Foto berhasil diunggah.');
    }

    // Method update menerima Photo yang spesifik untuk diubah
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $this->authorize('manage-galleries');
        $photo->update($request->validated());
        return back()->with('success', 'Detail foto berhasil diperbarui.');
    }

    // Method destroy menerima Photo yang spesifik untuk dihapus
    public function destroy(Photo $photo)
    {
        $this->authorize('manage-galleries');
        Storage::disk('public')->delete($photo->image_path);
        $photo->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
