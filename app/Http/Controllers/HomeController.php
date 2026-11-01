<?php

namespace App\Http\Controllers;

use App\Models\AcademicEvent;
use App\Models\Achievement;
use App\Models\AlumniTestimonial;
use App\Models\Extracurricular;
use App\Models\Page;
use App\Models\Post;
use App\Models\Staff;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Gunakan Cache::remember untuk menyimpan hasil query selama 60 menit.
        // Jika data ada di cache, Laravel tidak akan menjalankan query ke database.
        $statistics = Cache::remember('home_statistics', 60 * 60, function () {
            return [
                'teacherCount' => Staff::where('type', 'teacher')->count(),
                'extracurricularCount' => Extracurricular::count(),
                'achievementCount' => Achievement::count(),
            ];
        });

        // Query untuk data yang lebih sering berubah tidak perlu di-cache lama
        $latestPosts = Post::where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        $upcomingEvents = AcademicEvent::where('start_date', '>=', now()->today())
            ->orderBy('start_date', 'asc')
            ->take(2)
            ->get();

        $testimonials = AlumniTestimonial::latest()->take(2)->get();

        $infoPPDB = Page::where('title', 'Informasi Penerimaan Peserta Didik Baru')->first();
        $profilSekolah = Page::where('title', 'Visi Misi')->first();

        // Kirim semua data ke view menggunakan compact() untuk kode yang lebih bersih
        return view('public.home', compact(
            'statistics',
            'latestPosts',
            'upcomingEvents',
            'testimonials',
            'infoPPDB',
            'profilSekolah'
        ));
    }
}
