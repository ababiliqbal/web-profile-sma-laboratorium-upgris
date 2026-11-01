<?php

namespace App\Http\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class SettingComposer
{
    public function compose(View $view)
    {
        // Ambil semua settings dan ubah menjadi array (key => value)
        $settings = Setting::all()->keyBy('key')->map->value;

        // Kirim variabel $settings ke semua view
        $view->with('settings', $settings);
    }
}
