<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manage-categories'); // 3. Tambahkan Otorisasi
        $categories = Category::withCount('posts')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('manage-categories'); // 3. Tambahkan Otorisasi
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request) // 1. Gunakan Form Request
    {
        $this->authorize('manage-categories'); // 3. Tambahkan Otorisasi

        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        Category::create($data);

        // 4. Sesuaikan nama route
        return redirect()->route('dashboard.categories.index')->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('manage-categories'); // 3. Tambahkan Otorisasi
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category) // 2. Gunakan Form Request
    {
        $this->authorize('manage-categories'); // 3. Tambahkan Otorisasi

        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        // 4. Sesuaikan nama route
        return redirect()->route('dashboard.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('manage-categories'); // 3. Tambahkan Otorisasi

        if ($category->posts()->count() > 0) {
            // 4. Sesuaikan nama route dan tambahkan pesan error
            return redirect()->route('dashboard.categories.index')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki berita terkait.');
        }

        $category->delete();

        // 4. Sesuaikan nama route
        return redirect()->route('dashboard.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
