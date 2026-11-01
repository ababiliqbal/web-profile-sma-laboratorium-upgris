<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $this->authorize('manage-tags');
        $tags = Tag::withCount('posts')->latest()->paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        $this->authorize('manage-tags');
        return view('admin.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        $this->authorize('manage-tags');

        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        Tag::create($data);

        return redirect()->route('dashboard.tags.index')->with('success', 'Tag berhasil dibuat.');
    }

    public function edit(Tag $tag)
    {
        $this->authorize('manage-tags');
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $this->authorize('manage-tags');

        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $tag->update($data);

        return redirect()->route('dashboard.tags.index')->with('success', 'Tag berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('manage-tags');

        // Perbaikan: Untuk relasi many-to-many, kita tidak perlu mengecek count.
        // Cukup lepas semua relasi dari tabel pivot sebelum menghapus tag.
        // Ini memastikan tidak ada data yatim di tabel 'post_tag'.
        $tag->posts()->detach();

        $tag->delete();

        return redirect()->route('dashboard.tags.index')->with('success', 'Tag berhasil dihapus.');
    }
}
