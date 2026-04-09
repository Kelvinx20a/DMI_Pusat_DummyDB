<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HasilRapatKerjaController extends Controller
{
    public function index()
    {
        return view('layouts/proker/hasilrapatkerja');
    }
}
