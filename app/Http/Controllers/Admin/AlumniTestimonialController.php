<?php

// Pastikan namespace-nya benar
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlumniTestimonialRequest;
use App\Http\Requests\UpdateAlumniTestimonialRequest;
use App\Models\AlumniTestimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniTestimonialController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manage-alumni-testimonials');

        $query = AlumniTestimonial::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('testimonial', 'like', '%' . $request->search . '%');
        }

        $testimonials = $query->latest()->paginate(10)->withQueryString();

        return view('admin.alumni-testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        $this->authorize('manage-alumni-testimonials');
        return view('admin.alumni-testimonials.create');
    }

    public function store(StoreAlumniTestimonialRequest $request)
    {
        $this->authorize('manage-alumni-testimonials');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('alumni-testimonials', 'public');
        }

        AlumniTestimonial::create($data);

        return redirect()->route('dashboard.alumni-testimonials.index')->with('success', 'Testimoni alumni berhasil ditambahkan.');
    }

    public function edit(AlumniTestimonial $alumniTestimonial)
    {
        $this->authorize('manage-alumni-testimonials');
        return view('admin.alumni-testimonials.edit', compact('alumniTestimonial'));
    }

    public function update(UpdateAlumniTestimonialRequest $request, AlumniTestimonial $alumniTestimonial)
    {
        $this->authorize('manage-alumni-testimonials');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($alumniTestimonial->image_path) {
                Storage::disk('public')->delete($alumniTestimonial->image_path);
            }
            $data['image_path'] = $request->file('image')->store('alumni-testimonials', 'public');
        }

        $alumniTestimonial->update($data);

        return redirect()->route('dashboard.alumni-testimonials.index')->with('success', 'Testimoni alumni berhasil diperbarui.');
    }

    public function destroy(AlumniTestimonial $alumniTestimonial)
    {
        $this->authorize('manage-alumni-testimonials');

        if ($alumniTestimonial->image_path) {
            Storage::disk('public')->delete($alumniTestimonial->image_path);
        }

        $alumniTestimonial->delete();

        return redirect()->route('dashboard.alumni-testimonials.index')->with('success', 'Testimoni alumni berhasil dihapus.');
    }
}
