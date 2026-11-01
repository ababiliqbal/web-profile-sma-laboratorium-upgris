<?php

// Pastikan namespace-nya benar
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Models\Facility;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $this->authorize('manage-facilities');
        $facilities = Facility::orderBy('display_order', 'asc')->get();
        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        $this->authorize('manage-facilities');
        return view('admin.facilities.create');
    }

    public function store(StoreFacilityRequest $request)
    {
        $this->authorize('manage-facilities');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('facilities', 'public');
        }

        Facility::create($data);

        return redirect()->route('dashboard.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    // Method show() biasanya tidak diperlukan untuk modul ini
    // public function show(Facility $facility) {}

    public function edit(Facility $facility)
    {
        $this->authorize('manage-facilities');
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(UpdateFacilityRequest $request, Facility $facility)
    {
        $this->authorize('manage-facilities');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($facility->image_path) {
                Storage::disk('public')->delete($facility->image_path);
            }
            $data['image_path'] = $request->file('image')->store('facilities', 'public');
        }

        $facility->update($data);

        return redirect()->route('dashboard.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Facility $facility)
    {
        $this->authorize('manage-facilities');

        if ($facility->image_path) {
            Storage::disk('public')->delete($facility->image_path);
        }

        $facility->delete();

        return redirect()->route('dashboard.facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
