@extends('admin.layout.layout_admin')

@section('content')
<div class="settings-page" style="max-width:700px; margin:0 auto;">
    <div class="page-header" style="margin-bottom:24px;">
        <h2 style="font-size:20px; font-weight:700; margin:0 0 4px;">Pengaturan SEO</h2>
        <p style="font-size:13px; color:#6b7280; margin:0;">Atur meta tag, title, dan SEO situs secara global.</p>
    </div>

    @if(session('success'))
        <div style="background:#d1fae5; color:#065f46; padding:12px 16px; border-radius:8px; font-size:14px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('settings.update') }}">
        @csrf

        <div style="background:#fff; border-radius:12px; padding:24px; box-shadow:0 1px 3px rgba(0,0,0,0.06); margin-bottom:20px;">
            <h3 style="font-size:15px; font-weight:600; margin:0 0 16px; color:#111;">Informasi Situs</h3>

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:500; color:#374151; margin-bottom:4px;">Nama Situs</label>
                <input type="text" name="site.name" value="{{ old('site.name', $settings['site.name'] ?? '') }}"
                       style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
                @error('site.name') <small style="color:#ef4444;">{{ $message }}</small> @enderror
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:500; color:#374151; margin-bottom:4px;">Tagline</label>
                <input type="text" name="site.tagline" value="{{ old('site.tagline', $settings['site.tagline'] ?? '') }}"
                       style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:500; color:#374151; margin-bottom:4px;">Logo Path</label>
                <input type="text" name="site.logo" value="{{ old('site.logo', $settings['site.logo'] ?? '') }}"
                       style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
                <small style="color:#9ca3af;">Path relatif dari folder public/, contoh: admin-assets/img/logo dmi.png</small>
            </div>
        </div>

        <div style="background:#fff; border-radius:12px; padding:24px; box-shadow:0 1px 3px rgba(0,0,0,0.06); margin-bottom:20px;">
            <h3 style="font-size:15px; font-weight:600; margin:0 0 16px; color:#111;">SEO / Meta</h3>

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:500; color:#374151; margin-bottom:4px;">Meta Description</label>
                <textarea name="seo.meta_description" rows="3"
                          style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px; resize:vertical;">{{ old('seo.meta_description', $settings['seo.meta_description'] ?? '') }}</textarea>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:500; color:#374151; margin-bottom:4px;">Meta Keywords</label>
                <input type="text" name="seo.keywords" value="{{ old('seo.keywords', $settings['seo.keywords'] ?? '') }}"
                       style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;">
                <small style="color:#9ca3af;">Pisahkan dengan koma, contoh: masjid, dmi, berita islam</small>
            </div>
        </div>

        <div style="text-align:right;">
            <button type="submit"
                    style="background:#2E7D32; color:#fff; padding:10px 28px; border:none; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer;">
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
