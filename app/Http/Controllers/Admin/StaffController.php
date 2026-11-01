<?php

// Pastikan namespace-nya benar
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Staff;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manage-staffs');

        $query = Staff::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('position', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Perbaikan Bug: Hapus baris "$staffs = Staff::all();"
        $staffs = $query->orderBy('display_order', 'asc')->orderBy('name', 'asc')->paginate(15)->withQueryString();

        return view('admin.staffs.index', compact('staffs'));
    }

    public function create()
    {
        $this->authorize('manage-staffs');
        $subjects = Subject::all(); // Ambil data mapel untuk form
        return view('admin.staffs.create', compact('subjects'));
    }

    public function store(StoreStaffRequest $request)
    {
        $this->authorize('manage-staffs');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('staffs', 'public');
        }

        $staff = Staff::create($data);

        // Sinkronisasi mata pelajaran jika ada
        if ($request->has('subjects')) {
            $staff->subjects()->sync($request->input('subjects'));
        }

        return redirect()->route('dashboard.staffs.index')->with('success', 'Data staf berhasil ditambahkan.');
    }

    public function edit(Staff $staff)
    {
        $this->authorize('manage-staffs');
        $subjects = Subject::all();
        // Eager load relasi mapel yang sudah dimiliki staf ini
        $staff->load('subjects');
        return view('admin.staffs.edit', compact('staff', 'subjects'));
    }

    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        $this->authorize('manage-staffs');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($staff->image_path) {
                Storage::disk('public')->delete($staff->image_path);
            }
            $data['image_path'] = $request->file('image')->store('staffs', 'public');
        }

        $staff->update($data);

        // Sinkronisasi mata pelajaran
        $staff->subjects()->sync($request->input('subjects', []));

        return redirect()->route('dashboard.staffs.index')->with('success', 'Data staf berhasil diperbarui.');
    }

    public function destroy(Staff $staff)
    {
        $this->authorize('manage-staffs');

        if ($staff->image_path) {
            Storage::disk('public')->delete($staff->image_path);
        }

        // Lepas semua relasi sebelum menghapus
        $staff->subjects()->detach();
        $staff->delete();

        return redirect()->route('dashboard.staffs.index')->with('success', 'Data staf berhasil dihapus.');
    }
}
