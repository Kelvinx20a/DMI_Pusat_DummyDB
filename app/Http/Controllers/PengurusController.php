<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index()
    {
        return view ('layouts/tentang_kami/pengurus');
    }
    public function profil()
    {
        return view ('layouts/tentang_kami/profil');
    }

}
