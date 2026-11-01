<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manage-galleries');

        // 3. Mulai query dasar
        $query = Album::withCount('photos');

        // 4. Terapkan filter pencarian jika ada input
        if ($request->filled('search')) {
            $search = $request->search;
            // Cari di kolom 'name' ATAU 'description'
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // 5. Lakukan paginasi dan pertahankan query string saat berpindah halaman
        $albums = $query->latest()->paginate(12)->withQueryString();

        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        $this->authorize('manage-galleries');
        return view('admin.albums.create');
    }

    public function store(StoreAlbumRequest $request)
    {
        $this->authorize('manage-galleries');
        Album::create($request->validated());
        return redirect()->route('dashboard.albums.index')->with('success', 'Album berhasil dibuat.');
    }

    // Halaman ini akan menjadi pusat manajemen galeri untuk satu album
    public function show(Album $album)
    {
        $this->authorize('manage-galleries');
        $album->load('photos'); // Eager load relasi foto
        return view('admin.albums.show', compact('album'));
    }

    public function edit(Album $album)
    {
        $this->authorize('manage-galleries');
        return view('admin.albums.edit', compact('album'));
    }

    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $this->authorize('manage-galleries');
        $album->update($request->validated());
        return redirect()->route('dashboard.albums.index')->with('success', 'Album berhasil diperbarui.');
    }

    public function destroy(Album $album)
    {
        $this->authorize('manage-galleries');

        // Hapus semua file foto dari storage sebelum menghapus album
        foreach ($album->photos as $photo) {
            Storage::disk('public')->delete($photo->image_path);
        }

        $album->delete(); // Menghapus album akan otomatis menghapus relasi foto (jika onDelete('cascade') diatur)

        return redirect()->route('dashboard.albums.index')->with('success', 'Album dan semua isinya berhasil dihapus.');
    }
}
