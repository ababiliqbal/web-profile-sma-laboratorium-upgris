<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $this->authorize('manage-subjects');
        $subjects = Subject::withCount('staffs')->latest()->paginate(15);
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $this->authorize('manage-subjects');
        return view('admin.subjects.create');
    }

    public function store(StoreSubjectRequest $request)
    {
        $this->authorize('manage-subjects');
        Subject::create($request->validated());
        return redirect()->route('dashboard.subjects.index')->with('success', 'Mata Pelajaran berhasil dibuat.');
    }

    public function edit(Subject $subject)
    {
        $this->authorize('manage-subjects');
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $this->authorize('manage-subjects');
        $subject->update($request->validated());
        return redirect()->route('dashboard.subjects.index')->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    public function destroy(Subject $subject)
    {
        $this->authorize('manage-subjects');
        $subject->staffs()->detach();
        $subject->delete();
        return redirect()->route('dashboard.subjects.index')->with('success', 'Mata Pelajaran berhasil dihapus.');
    }
}
