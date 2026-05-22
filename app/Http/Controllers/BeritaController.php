<?php

namespace App\Http\Controllers;

use App\Models\PostTag;
use App\Models\WordpressPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function berita()
    {
        $posts = WordpressPost::with(['author', 'meta'])
            ->where('post_type', 'post')
            ->where('post_status', 'publish')
            ->orderBy('post_date', 'desc')
            ->take(18)
            ->get()
            ->map(fn ($post) => $this->decoratePost($post));

        return view('layouts.redaksi.berita', [
            'headlinePosts' => $posts->take(3),
            'gridPosts' => $posts->slice(3, 6),
            'popularPosts' => $this->popularPosts(),
            'latestPosts' => $posts->slice(9, 4),
            'archivePosts' => $posts->slice(13, 3),
        ]);
    }

    public function berita2(?int $post = null)
    {
        $post = $post
            ? WordpressPost::with(['author', 'meta'])->findOrFail($post)
            : WordpressPost::with(['author', 'meta'])
                ->where('post_type', 'post')
                ->where('post_status', 'publish')
                ->orderBy('post_date', 'desc')
                ->firstOrFail();

        abort_unless($post->post_type === 'post' && $post->post_status === 'publish', 404);

        return view('layouts.redaksi.detailberita', [
            'post' => $this->decoratePost($post),
            'popularPosts' => $this->popularPosts($post->ID),
        ]);
    }

    public function berita3(Request $request)
    {
        $posts = WordpressPost::with(['author', 'meta'])
            ->where('post_type', 'post')
            ->where('post_status', 'publish')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('post_title', 'like', '%' . $request->search . '%')
                        ->orWhere('post_content', 'like', '%' . $request->search . '%');
                });
            })
            ->orderBy('post_date', 'desc')
            ->paginate(9)
            ->withQueryString();

        $posts->getCollection()->transform(fn ($post) => $this->decoratePost($post));

        return view('layouts.redaksi.semua-berita', compact('posts'));
    }

    private function decoratePost(WordpressPost $post): WordpressPost
    {
        $tags = PostTag::where('post_id', $post->ID)->pluck('tag_name');
        $category = $post->getMeta('tagline_berita') ?: $tags->first() ?: 'Berita';

        $post->frontend_category = $category;
        $post->frontend_author = $post->getMeta('nama_penulis') ?: ($post->author->user_nicename ?? 'Admin');
        $post->frontend_image = $post->getImageUrl() ?: asset('admin-assets/img/logo dmi.png');
        $post->frontend_excerpt = $post->post_excerpt ?: Str::limit(strip_tags($post->post_content), 160);
        $post->frontend_reading_time = max(1, ceil(str_word_count(strip_tags($post->post_content)) / 200));
        $post->frontend_url = route('redaksi.berita.detail', $post->ID);
        $post->frontend_tags = $tags->isNotEmpty() ? $tags : collect([$category]);

        return $post;
    }

    private function popularPosts(?int $exceptId = null)
    {
        $query = WordpressPost::with(['author', 'meta'])
            ->where('post_type', 'post')
            ->where('post_status', 'publish')
            ->when($exceptId, fn ($query) => $query->where('ID', '!=', $exceptId));

        $postIdsByViews = DB::connection('wordpress')
            ->table('ism13qf_postmeta')
            ->where('meta_key', 'trx_addons_post_views_count')
            ->orderByRaw('CAST(meta_value AS UNSIGNED) DESC')
            ->pluck('post_id')
            ->all();

        if (! empty($postIdsByViews)) {
            $query->whereIn('ID', $postIdsByViews)
                ->orderByRaw('FIELD(ID, ' . implode(',', array_map('intval', $postIdsByViews)) . ')');
        } else {
            $query->orderBy('post_date', 'desc');
        }

        return $query->take(8)->get()->map(fn ($post) => $this->decoratePost($post));
    }
}
