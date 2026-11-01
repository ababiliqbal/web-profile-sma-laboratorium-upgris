<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Post;
use App\Models\Staff;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // 1. Validasi input pencarian
        $request->validate([
            'q' => 'required|string|min:3',
        ]);

        $query = $request->input('q');

        // 2. Lakukan pencarian di beberapa model sekaligus

        // Cari di Berita (Posts)
        $posts = Post::where('status', 'published')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->paginate(5, ['*'], 'posts_page') // Paginasi terpisah untuk setiap model
            ->withQueryString();

        // Cari di Halaman Statis (Pages)
        $pages = Page::where('status', 'published')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(5, ['*'], 'pages_page')
            ->withQueryString();


        // 3. Hitung total hasil yang ditemukan
        $totalResults = $posts->total() + $pages->total();

        // 4. Kirim semua data ke view
        return view('public.search', compact('posts', 'pages', 'query', 'totalResults'));
    }
}
