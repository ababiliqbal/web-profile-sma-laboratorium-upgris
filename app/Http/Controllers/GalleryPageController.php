<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class GalleryPageController extends Controller
{
    public function index(Request $request)
    {
        $query = Album::with('photos')->withCount('photos');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $sort = $request->input('sort', 'terbaru'); // Default 'terbaru'
        switch ($sort) {
            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;
            case 'terbanyak':
                $query->orderBy('photos_count', 'desc');
                break;
            default:
                $query->latest(); // Urutan 'terbaru'
                break;
        }

        $albums = $query->paginate(9)->withQueryString();

        return view('public.galleries.index', compact('albums'));
    }

    public function show(Album $album)
    {
        $album->load('photos');

        return view('public.galleries.show', compact('album'));
    }
}
