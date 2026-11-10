<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'school_name' => 'SMA Laboratorium UPGRIS',
            'school_tagline' => 'Membentuk Insan Cerdas, Kompetitif, dan Berkarakter Pancasila.',
            'school_address' => 'Jl. Sidodadi Timur No. 24, Karangtempel, Kec. Semarang Timur, Kota Semarang, Jawa Tengah 50125',
            'school_phone' => '(024) 8448332',
            'school_email' => 'smalaboratoriumupgris@gmail.com',
            'gmaps_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2223078491854!2d110.4357!3d-6.983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708cbb398fdb57%3A0x6b5a36be5b847118!2sSMA%20Laboratorium%20UPGRIS!5e0!3m2!1sid!2sid!4v1690000000000!5m2!1sid!2sid',
            'facebook_url' => 'https://facebook.com/smalabupgris',
            'instagram_url' => 'https://instagram.com/smalabupgris',
            'youtube_url' => 'https://youtube.com/@smalaboratoriumupgris',
            'twitter_url' => 'https://twitter.com/smalabupgris',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}

