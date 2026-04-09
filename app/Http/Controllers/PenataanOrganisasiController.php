<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenataanOrganisasiController extends Controller
{
    public function index()
    {
        return view('layouts/proker/organisasi');
    }
}
