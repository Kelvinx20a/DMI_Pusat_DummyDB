<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = [
            'site.name' => 'required|string|max:255',
            'site.tagline' => 'nullable|string|max:255',
            'seo.meta_description' => 'nullable|string|max:500',
            'seo.keywords' => 'nullable|string|max:500',
            'site.logo' => 'nullable|string|max:255',
        ];

        $validated = $request->validate($fields);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('settings.index')
            ->with('success', 'Pengaturan berhasil disimpan.');
    }
}
