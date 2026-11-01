<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Traits\FileUploadTrait;

class PageController extends Controller
{

    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view-pages');
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create-pages');
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        $this->authorize('create-pages');

        // $data sekarang sudah otomatis berisi semua field yang tervalidasi, termasuk field SEO & alt
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('pages', 'public');
        }

        Page::create($data);

        return redirect()->route('dashboard.pages.index')->with('success', 'Halaman berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        $this->authorize('edit-pages');
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $this->authorize('edit-pages');

        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            if ($page->image_path) {
                Storage::disk('public')->delete($page->image_path);
            }
            $data['image_path'] = $request->file('image')->store('pages', 'public');
        }

        $page->update($data);

        $this->handleMultipleFileUploads($request, $page, 'documents', 'documents/pages');

        return redirect()->route('dashboard.pages.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $this->authorize('delete-pages');

        // Hapus gambar terkait sebelum menghapus record dari database
        if ($page->image_path) {
            Storage::disk('public')->delete($page->image_path);
        }

        $page->delete();
        return back()->with('success', 'Halaman berhasil dihapus.');
    }
}
