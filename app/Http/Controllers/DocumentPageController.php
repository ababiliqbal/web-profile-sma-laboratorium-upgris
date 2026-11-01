<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentPageController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::query();

        // Terapkan filter pencarian jika ada
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Ambil semua dokumen dengan paginasi
        $documents = $query->latest()->paginate(12)->withQueryString();

        return view('public.documents.index', compact('documents'));
    }
}
