<?php

namespace App\Http\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class SettingComposer
{
    public function compose(View $view)
    {
        // Default pengaturan sebagai fallback jika data di database belum diset
        $defaultSettings = [
            'school_name' => 'SMA Laboratorium UPGRIS',
            'school_tagline' => 'Membentuk Insan Cerdas, Kompetitif, dan Berkarakter Pancasila.',
            'school_address' => 'Jl. Sidodadi Timur No. 24, Karangtempel, Semarang',
            'school_phone' => '(024) 8448332',
            'school_email' => 'info@smalabupgris.sch.id',
            'gmaps_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2223078491854!2d110.4357!3d-6.983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTgnNTguOCJTIDExMMKwMjYnMDguNSJF!5e0!3m2!1sid!2sid!4v1600000000000!5m2!1sid!2sid',
        ];

        // Ambil semua settings dari database dan ubah menjadi array (key => value)
        $dbSettings = Setting::all()->pluck('value', 'key')->toArray();

        // Gabungkan default dengan data database (data database menimpa default)
        $settings = array_merge($defaultSettings, $dbSettings);

        // Kirim variabel $settings ke semua view
        $view->with('settings', $settings);
    }
}
