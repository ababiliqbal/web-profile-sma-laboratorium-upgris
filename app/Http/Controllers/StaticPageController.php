<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function show(Page $page)
    {
        // Pastikan hanya halaman yang statusnya "published" yang bisa diakses oleh publik
        if ($page->status !== 'published') {
            abort(404);
        }

        // Eager load dokumen terkait jika ada
        $page->load('documents');

        return view('public.pages.show', compact('page'));
    }
}
