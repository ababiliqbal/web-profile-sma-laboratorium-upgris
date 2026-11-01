<?php

namespace App\Http\Controllers;

use App\Models\AcademicEvent;
use Illuminate\Http\Request;

class AcademicEventPageController extends Controller
{
    public function index()
    {
        // Ambil semua data acara dari database
        $allEvents = AcademicEvent::orderBy('start_date', 'asc')->get();

        // "Terjemahkan" data agar sesuai format yang dibutuhkan Alpine.js
        $eventData = $allEvents->map(function ($event) {
            // Mapping kategori ke kelas warna Tailwind
            $categoryColorMap = [
                'academic' => 'bg-blue-500',
                'ppdb'     => 'bg-yellow-500',
                'event'    => 'bg-green-500',
                'holiday'  => 'bg-red-500',
            ];

            return [
                'id'            => $event->id,
                'title'         => $event->title,
                'description'   => $event->description ?? '',
                'startDate'     => $event->start_date->toDateString(), // Format Y-m-d
                'endDate'       => $event->end_date ? $event->end_date->toDateString() : $event->start_date->toDateString(),
                'category'      => $event->category,
                'categoryColor' => $categoryColorMap[$event->category] ?? 'bg-gray-500',
            ];
        });

        // Kirim data yang sudah di-transform ke view
        return view('public.academic-events.index', [
            'eventData' => $eventData
        ]);
    }
}
