<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkustikMasjidController extends Controller
{
    public function index()
    {
        return view('layouts/proker/akustikmasjid');
    }
}
