<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function event()
    {
        session(['event_origin' => ['label' => 'Event Bulan Ini', 'url' => '/kegiatan/event-bulan-ini']]);
        return view('layouts/kegiatan/event');
    }
    public function kalender()
    {
        session(['event_origin' => ['label' => 'Kalender Event', 'url' => '/kegiatan/kalender-event']]);
        return view('layouts/kegiatan/kalender');
    }
    public function detail()
    {
        return view('layouts/kegiatan/detail-event');
    }
}
