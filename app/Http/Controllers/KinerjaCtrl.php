<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KriteriaPenilaian as KP;
class KinerjaCtrl extends Controller
{
    public function __construct($value=''){
    	$this->middleware('auth');
    }

    public function getIndex(){
    	$kriteria = KP::orderBy('id')->get();
    	return view('penilaian.formulir_penilaian')->withKriteria($kriteria);
    }
}
