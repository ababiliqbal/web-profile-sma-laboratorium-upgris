<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Staff;
use App\Models\Tag;

class PostPageController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $postQuery = Post::published()->with(['category', 'user']);

        if ($request->filled('search')) {
            $postQuery->where('title', 'like', '%' . $request->search . '%');
        }

        $featuredPost = (clone $postQuery)->latest('published_at')->first();

        $posts = (clone $postQuery)
            ->when($featuredPost, fn($q) => $q->where('id', '!=', $featuredPost->id))
            ->latest('published_at')
            ->paginate(6)
            ->withQueryString();

        return view('public.posts.index', compact('categories', 'featuredPost', 'posts'));
    }

    public function category(Category $category)
    {
        $categories = Category::all();

        $posts = $category->posts()
            ->published()
            ->with(['category', 'user']) // agar konsisten dengan index()
            ->latest('published_at')
            ->paginate(9);

        $featuredPost = null;

        return view('public.posts.index', compact('categories', 'featuredPost', 'posts', 'category'));
    }

    public function tag(Tag $tag)
    {
        // Ambil semua kategori untuk ditampilkan di filter
        $categories = Category::all();

        // 2. Ambil semua post yang dimiliki oleh tag ini, dengan paginasi
        $posts = $tag->posts() // Menggunakan relasi many-to-many
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        // Featured post tidak ada di halaman arsip
        $featuredPost = null;

        // 3. Kirim data posts DAN data tag ke view yang SAMA (posts.index)
        return view('public.posts.index', compact('categories', 'featuredPost', 'posts', 'tag'));
    }

    public function show(Post $post)
    {
        // Pastikan hanya postingan yang 'published' yang bisa diakses
        if ($post->status !== 'published') {
            abort(404);
        }

        // 2. Logika untuk mencari profil penulis di tabel 'staffs'
        // Kita cari staf yang memiliki nama yang sama dengan penulis post
        $authorProfile = Staff::where('name', $post->user->name)->first();

        // 3. Ambil 3 artikel terkait dari kategori yang sama (kecuali artikel ini sendiri)
        $relatedPosts = Post::where('status', 'published')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        // Kirim semua data yang dibutuhkan ke view
        return view('public.posts.show', compact('post', 'authorProfile', 'relatedPosts'));
    }
}
