<?php

// Pastikan namespace-nya benar
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentOrganizationRequest;
use App\Http\Requests\UpdateStudentOrganizationRequest;
use App\Models\Staff; //
use App\Models\StudentOrganization;
use Illuminate\Support\Facades\Storage;

class StudentOrganizationController extends Controller
{
    public function index()
    {
        $this->authorize('manage-student-organizations');
        $organizations = StudentOrganization::with('supervisor')->latest()->paginate(12);
        return view('admin.student-organizations.index', compact('organizations'));
    }

    public function create()
    {
        $this->authorize('manage-student-organizations');
        $teachers = Staff::where('type', 'teacher')->orderBy('name')->get();
        return view('admin.student-organizations.create', compact('teachers'));
    }

    public function store(StoreStudentOrganizationRequest $request)
    {
        $this->authorize('manage-student-organizations');

        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('student-organizations', 'public');
        }

        StudentOrganization::create($data);
        return redirect()->route('dashboard.student-organizations.index')->with('success', 'Organisasi Siswa berhasil ditambahkan.');
    }

    public function edit(StudentOrganization $studentOrganization)
    {
        $this->authorize('manage-student-organizations');
        $teachers = Staff::where('type', 'teacher')->orderBy('name')->get();
        return view('admin.student-organizations.edit', compact('studentOrganization', 'teachers'));
    }

    public function update(UpdateStudentOrganizationRequest $request, StudentOrganization $studentOrganization)
    {
        $this->authorize('manage-student-organizations');

        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($studentOrganization->logo_path) {
                Storage::disk('public')->delete($studentOrganization->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('student-organizations', 'public');
        }

        $studentOrganization->update($data);

        return redirect()->route('dashboard.student-organizations.index')->with('success', 'Organisasi Siswa berhasil diperbarui.');
    }

    public function destroy(StudentOrganization $studentOrganization)
    {
        $this->authorize('manage-student-organizations');

        if ($studentOrganization->logo_path) {
            Storage::disk('public')->delete($studentOrganization->logo_path);
        }

        $studentOrganization->delete();

        return redirect()->route('dashboard.student-organizations.index')->with('success', 'Organisasi Siswa berhasil dihapus.');
    }
}
