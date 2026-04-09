<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProkerDMIController extends Controller
{
    public function index(){
        return view ('layouts/proker/prokerDMI');
    }
    public function index2(){
        return view ('layouts/proker/ekonomi');
    }
    public function index3(){
        return view ('layouts/proker/kemasjidan');
    }

    public function index4(){
        return view ('layouts/proker/lingkungan');
    }
    public function index5(){
        return view ('layouts/proker/sertifikat-tanah-wakaf');
    }
    public function index6(){
        return view ('layouts/proker/masjid-ramah-jamaah');
    }
    
    public function index7(){
        return view ('layouts/proker/masjid-bersih-dan-sehat');
    }

    public function index8(){
        return view ('layouts/proker/pendidikan-dan-dakwah');
    }
    public function index9(){
        return view ('layouts/proker/arsitektur-masjid');
    }
    public function index10(){
        return view ('layouts/proker/wisata-religi');
    }

}
