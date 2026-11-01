<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan.
     * Semua data diambil dan diubah menjadi format yang mudah diakses oleh view.
     */
    public function index()
    {
        $this->authorize('manage-settings');

        // Ambil semua settings dan ubah menjadi array asosiatif (key => value)
        $settings = Setting::all()->keyBy('key')->map(function ($setting) {
            return $setting->value;
        });

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Memperbarui semua pengaturan.
     */
    public function update(UpdateSettingRequest $request)
    {
        $this->authorize('manage-settings');

        $data = $request->validated();

        // Handle upload logo baru
        if ($request->hasFile('school_logo')) {
            $this->updateFileSetting('school_logo', $request->file('school_logo')->store('settings', 'public'));
        }

        // Handle upload favicon baru
        if ($request->hasFile('school_favicon')) {
            $this->updateFileSetting('school_favicon', $request->file('school_favicon')->store('settings', 'public'));
        }

        // Loop melalui semua data yang tervalidasi (kecuali file) dan simpan ke database
        foreach ($data as $key => $value) {
            // Lewati file karena sudah dihandle di atas
            if ($request->hasFile($key)) {
                continue;
            }

            // Gunakan updateOrCreate untuk efisiensi:
            // Jika key sudah ada, update value-nya.
            // Jika key belum ada, buat record baru.
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui.');
    }

    /**
     * Method helper untuk mengupdate setting berupa file.
     */
    private function updateFileSetting(string $key, string $newPath)
    {
        $oldPath = Setting::where('key', $key)->value('value');

        // Hapus file lama jika ada
        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        // Simpan path file baru
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $newPath]
        );
    }
}
