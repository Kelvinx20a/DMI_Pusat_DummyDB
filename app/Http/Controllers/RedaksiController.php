<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedaksiController extends Controller
{
    public function susunanredaksi()
    {
        return view('layouts/redaksi/susunanredaksi');
    }
}
