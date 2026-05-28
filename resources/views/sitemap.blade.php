<?php echo '<' . '?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($staticPages as $page)
    <url>
        <loc>{{ $page['loc'] }}</loc>
        <priority>{{ $page['priority'] }}</priority>
        <changefreq>{{ $page['changefreq'] }}</changefreq>
    </url>
@endforeach
@foreach($posts as $post)
    <url>
        <loc>{{ route('redaksi.berita.detail', $post->post_name) }}</loc>
        <lastmod>{{ $post->post_modified ?? $post->post_date }}</lastmod>
        <priority>0.6</priority>
        <changefreq>weekly</changefreq>
    </url>
@endforeach
</urlset>
