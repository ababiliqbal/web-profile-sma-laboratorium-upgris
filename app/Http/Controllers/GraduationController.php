<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class GraduationController extends Controller
{
    public function index()
    {
        return view('kelulusan.index');
    }

    public function check(Request $request)
    {
        // Validasi input
        $request->validate([
            'nisn' => 'required|numeric',
            'password' => 'required'
        ]);

        // Cek password statis dari klien
        if ($request->password !== '20328929') {
            return back()->with('error', 'Password yang Anda masukkan salah.');
        }

        // Cari data siswa berdasarkan NISN
        $student = Student::where('nisn', $request->nisn)->first();

        if (!$student) {
            return back()->with('error', 'Data NISN tidak ditemukan di sistem kami.');
        }

        // Tampilkan halaman SK Kelulusan
        return view('kelulusan.result', compact('student'));
    }
}
