<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementPageController extends Controller
{
    public function index()
    {
        // Ambil semua data prestasi dari database, urutkan dari yang terbaru
        $achievements = Achievement::latest('date')->paginate(9);

        return view('public.achievements.index', compact('achievements'));
    }
}
