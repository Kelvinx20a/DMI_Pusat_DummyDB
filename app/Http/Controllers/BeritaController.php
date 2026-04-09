<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function berita()
    {
        return view ('layouts/redaksi/berita');
    }
    public function berita2()
    {
        return view ('layouts/redaksi/detailberita');
    }
}
