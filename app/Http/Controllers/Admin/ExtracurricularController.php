<?php

// Pastikan namespace-nya benar
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExtracurricularRequest;
use App\Http\Requests\UpdateExtracurricularRequest;
use App\Models\Extracurricular;
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;

class ExtracurricularController extends Controller
{
    public function index()
    {
        $this->authorize('manage-extracurriculars');
        $extracurriculars = Extracurricular::with('coach')->latest()->paginate(12);
        return view('admin.extracurriculars.index', compact('extracurriculars'));
    }

    public function create()
    {
        $this->authorize('manage-extracurriculars');
        $teachers = Staff::where('type', 'teacher')->orderBy('name')->get();
        return view('admin.extracurriculars.create', compact('teachers'));
    }

    public function store(StoreExtracurricularRequest $request)
    {
        $this->authorize('manage-extracurriculars');

        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('extracurriculars', 'public');
        }

        Extracurricular::create($data);

        return redirect()->route('dashboard.extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    public function edit(Extracurricular $extracurricular)
    {
        $this->authorize('manage-extracurriculars');
        $teachers = Staff::where('type', 'teacher')->orderBy('name')->get();
        return view('admin.extracurriculars.edit', compact('extracurricular', 'teachers'));
    }

    public function update(UpdateExtracurricularRequest $request, Extracurricular $extracurricular)
    {
        $this->authorize('manage-extracurriculars');

        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($extracurricular->logo_path) {
                Storage::disk('public')->delete($extracurricular->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('extracurriculars', 'public');
        }

        $extracurricular->update($data);

        return redirect()->route('dashboard.extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(Extracurricular $extracurricular)
    {
        $this->authorize('manage-extracurriculars');

        if ($extracurricular->logo_path) {
            Storage::disk('public')->delete($extracurricular->logo_path);
        }

        $extracurricular->delete();

        return redirect()->route('dashboard.extracurriculars.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
