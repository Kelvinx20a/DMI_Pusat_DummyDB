<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrixUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp,avif|max:5120',
        ]);

        $path = $request->file('file')->store('berita/content', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }
}
