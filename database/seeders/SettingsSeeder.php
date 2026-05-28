<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            ['key' => 'site.name', 'value' => 'DMI - Dewan Masjid Indonesia'],
            ['key' => 'site.tagline', 'value' => 'Portal resmi informasi, berita, dan kegiatan DMI'],
            ['key' => 'seo.meta_description', 'value' => 'Portal resmi Dewan Masjid Indonesia — informasi terkini seputar kegiatan, program kerja, dan pengembangan masjid di seluruh Indonesia.'],
            ['key' => 'seo.keywords', 'value' => 'dewan masjid indonesia, dmi, masjid, berita masjid, organisasi masjid, islam indonesia'],
            ['key' => 'site.logo', 'value' => 'admin-assets/img/logo dmi.png'],
        ];

        foreach ($defaults as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
