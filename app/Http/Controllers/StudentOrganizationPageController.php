<?php

namespace App\Http\Controllers;

use App\Models\StudentOrganization;
use Illuminate\Http\Request;

class StudentOrganizationPageController extends Controller
{
    public function index()
    {
        // Ambil semua data organisasi siswa, eager load relasi 'supervisor' untuk efisiensi
        $organizations = StudentOrganization::with('supervisor')
            ->latest()
            ->get();

        return view('public.student-organizations.index', compact('organizations'));
    }
}
