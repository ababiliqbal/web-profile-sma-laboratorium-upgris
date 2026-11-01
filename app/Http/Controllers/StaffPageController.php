<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaffPageController extends Controller
{
    /**
     * Menampilkan halaman daftar guru dan staf untuk publik.
     */
    public function index()
    {
        $allStaff = Staff::with('subjects')
            ->orderBy('display_order', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        $staffData = $allStaff->map(function ($staff) {

            $kategori = $staff->type;
            $kataKunciPimpinan = ['kepala sekolah', 'wakil kepala sekolah', 'waka', 'kaprog'];
            foreach ($kataKunciPimpinan as $keyword) {
                if (Str::contains($staff->position, $keyword, true)) {
                    $kategori = 'kepemimpinan';
                    break;
                }
            }

            return [
                'id'       => $staff->id,
                'nama'     => $staff->name,
                'posisi'   => $staff->position,
                'kategori' => $kategori,
                'type'     => $staff->type,
                'status'   => ucfirst(str_replace('_', ' ', $staff->employment_status)),
                'nip'      => $staff->identity_number ?? '-',
                'email'    => $staff->email ?? '-',
                'foto'     => $staff->image_path ? asset('storage/' . $staff->image_path) : 'https://placehold.co/400x400/E2E8F0/334155?text=' . substr($staff->name, 0, 1),
                'imageAlt' => $staff->image_alt,
                'bio'      => $staff->biography ?? 'Tidak ada biografi.',
                'mapel'    => $staff->subjects->pluck('name')->toArray(),
            ];
        });

        return view('public.staffs.index', [
            'staffData' => $staffData
        ]);
    }
}
