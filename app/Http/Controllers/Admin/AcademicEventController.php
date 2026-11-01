<?php

// Pastikan namespace-nya benar
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcademicEventRequest;
use App\Http\Requests\UpdateAcademicEventRequest;
use App\Models\AcademicEvent;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;

class AcademicEventController extends Controller
{
    use FileUploadTrait;
    public function index(Request $request)
    {
        $this->authorize('manage-academic-events');

        $query = AcademicEvent::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Mengurutkan berdasarkan tanggal mulai, dari yang terdekat
        $events = $query->orderBy('start_date', 'asc')->paginate(15)->withQueryString();

        return view('admin.academic-events.index', compact('events'));
    }

    public function create()
    {
        $this->authorize('manage-academic-events');
        return view('admin.academic-events.create');
    }

    public function store(StoreAcademicEventRequest $request)
    {
        $this->authorize('manage-academic-events');
        AcademicEvent::create($request->validated());
        return redirect()->route('dashboard.academic-events.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(AcademicEvent $academicEvent)
    {
        $this->authorize('manage-academic-events');
        return view('admin.academic-events.edit', compact('academicEvent'));
    }

    public function update(UpdateAcademicEventRequest $request, AcademicEvent $academicEvent)
    {
        $this->authorize('manage-academic-events');
        $academicEvent->update($request->validated());

        $this->handleMultipleFileUploads($request, $academicEvent, 'documents', 'documents/events');
        return redirect()->route('dashboard.academic-events.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(AcademicEvent $academicEvent)
    {
        $this->authorize('manage-academic-events');
        $academicEvent->delete();
        return redirect()->route('dashboard.academic-events.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
