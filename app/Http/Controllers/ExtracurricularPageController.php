<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Extracurricular;

class ExtracurricularPageController extends Controller
{
    public function index()
    {
        // Ambil semua data ekstrakurikuler, eager load relasi 'coach' untuk efisiensi
        $extracurriculars = Extracurricular::with('coach')
            ->latest()
            ->get();

        return view('public.extracurriculars.index', compact('extracurriculars'));
    }
}
