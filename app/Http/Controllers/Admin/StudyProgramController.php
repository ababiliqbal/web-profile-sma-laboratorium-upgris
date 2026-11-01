<?php

// Pastikan namespace-nya benar
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudyProgramRequest;
use App\Http\Requests\UpdateStudyProgramRequest;
use App\Models\Staff; // 1. Ganti Teacher dengan Staff
use App\Models\StudyProgram;
use Illuminate\Support\Facades\Storage;

class StudyProgramController extends Controller
{
    public function index()
    {
        $this->authorize('manage-study-programs');
        // 2. Eager load relasi dengan headStaff (nama relasi di model StudyProgram)
        $studyPrograms = StudyProgram::with('headStaff')->latest()->paginate(10);
        return view('admin.study-programs.index', compact('studyPrograms'));
    }

    public function create()
    {
        $this->authorize('manage-study-programs');
        // 3. Ambil data guru saja (type = 'teacher') untuk dropdown Kepala Jurusan
        $teachers = Staff::where('type', 'teacher')->orderBy('name')->get();
        return view('admin.study-programs.create', compact('teachers'));
    }

    public function store(StoreStudyProgramRequest $request)
    {
        $this->authorize('manage-study-programs');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('study-programs', 'public');
        }

        StudyProgram::create($data);

        // 4. Sesuaikan nama route
        return redirect()->route('dashboard.study-programs.index')->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function edit(StudyProgram $studyProgram)
    {
        $this->authorize('manage-study-programs');
        $teachers = Staff::where('type', 'teacher')->orderBy('name')->get();
        return view('admin.study-programs.edit', compact('studyProgram', 'teachers'));
    }

    public function update(UpdateStudyProgramRequest $request, StudyProgram $studyProgram)
    {
        $this->authorize('manage-study-programs');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($studyProgram->image_path) {
                Storage::disk('public')->delete($studyProgram->image_path);
            }
            $data['image_path'] = $request->file('image')->store('study-programs', 'public');
        }

        $studyProgram->update($data);

        return redirect()->route('dashboard.study-programs.index')->with('success', 'Program Studi berhasil diperbarui.');
    }

    public function destroy(StudyProgram $studyProgram)
    {
        $this->authorize('manage-study-programs');

        if ($studyProgram->image_path) {
            Storage::disk('public')->delete($studyProgram->image_path);
        }

        $studyProgram->delete();

        return redirect()->route('dashboard.study-programs.index')->with('success', 'Program Studi berhasil dihapus.');
    }
}
