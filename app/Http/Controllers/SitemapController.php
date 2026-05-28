<?php

namespace App\Http\Controllers;

use App\Models\WordpressPost;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = WordpressPost::with(['author', 'meta'])
            ->where('post_type', 'post')
            ->where('post_status', 'publish')
            ->orderBy('post_date', 'desc')
            ->get();

        $staticPages = [
            ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => route('redaksi.berita'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['loc' => route('redaksi.berita.semua'), 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['loc' => url('/redaksi/susunan-redaksi'), 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => url('/tentang-kami/profil'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => url('/tentang-kami/pengurus'), 'priority' => '0.5', 'changefreq' => 'monthly'],
        ];

        $content = view('sitemap', compact('posts', 'staticPages'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }
}
