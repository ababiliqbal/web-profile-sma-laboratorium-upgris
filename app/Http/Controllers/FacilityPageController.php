<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityPageController extends Controller
{
    /**
     * Menampilkan halaman daftar fasilitas untuk publik.
     */
    public function index()
    {
        // 1. Ambil semua data fasilitas, urutkan sesuai display_order
        $allFacilities = Facility::orderBy('display_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        // 2. "Terjemahkan" data agar sesuai format yang dibutuhkan Alpine.js
        $facilityData = $allFacilities->map(function ($facility, $index) {
            // --- (PERBAIKAN KUNCI ADA DI SINI) ---
            // Logika untuk membuat pola grid masonry 4 item
            $patternIndex = $index % 4; // Hasilnya akan 0, 1, 2, atau 3
            $span = '';

            switch ($patternIndex) {
                case 0: // Item pertama dalam pola (index 0, 4, 8, ...)
                    $span = 'col-span-2';
                    break;
                case 1: // Item kedua (index 1, 5, 9, ...)
                    $span = 'col-span-2';
                    break;
                case 2: // Item ketiga (index 2, 6, 10, ...)
                    $span = 'col-span-2';
                    break;
                case 3: // Item keempat (index 3, 7, 11, ...)
                    $span = 'col-span-2';
                    break;
            }

            return [
                'id'          => $facility->id,
                'name'        => $facility->name,
                'description' => $facility->description ?? 'Tidak ada deskripsi detail.',
                // Gunakan placeholder jika foto tidak ada
                'imageUrl'    => $facility->image_path
                    ? asset('storage/' . $facility->image_path)
                    : 'https://placehold.co/800x800/E2E8F0/334155?text=' . urlencode($facility->name),
                'imageAlt' => $facility->image_alt,
                'span'        => $span
            ];
        });

        // 3. Kirim data yang sudah di-transform ke view
        return view('public.facilities.index', [
            'facilityData' => $facilityData
        ]);
    }
}
