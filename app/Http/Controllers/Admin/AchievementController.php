<?php

// Pastikan namespace-nya benar
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAchievementRequest;
use App\Http\Requests\UpdateAchievementRequest;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manage-achievements');

        $query = Achievement::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Mengurutkan berdasarkan tanggal, dari yang terbaru
        $achievements = $query->latest('date')->paginate(10)->withQueryString();

        return view('admin.achievements.index', compact('achievements'));
    }

    public function create()
    {
        $this->authorize('manage-achievements');
        return view('admin.achievements.create');
    }

    public function store(StoreAchievementRequest $request)
    {
        $this->authorize('manage-achievements');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('achievements', 'public');
        }

        Achievement::create($data);

        return redirect()->route('dashboard.achievements.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function edit(Achievement $achievement)
    {
        $this->authorize('manage-achievements');
        return view('admin.achievements.edit', compact('achievement'));
    }

    public function update(UpdateAchievementRequest $request, Achievement $achievement)
    {
        $this->authorize('manage-achievements');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($achievement->image_path) {
                Storage::disk('public')->delete($achievement->image_path);
            }
            $data['image_path'] = $request->file('image')->store('achievements', 'public');
        }

        $achievement->update($data);

        return redirect()->route('dashboard.achievements.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(Achievement $achievement)
    {
        $this->authorize('manage-achievements');

        if ($achievement->image_path) {
            Storage::disk('public')->delete($achievement->image_path);
        }

        $achievement->delete();

        return redirect()->route('dashboard.achievements.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}
