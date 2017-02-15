<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AktifitasKerja;
use DB;
use Carbon\Carbon;
class AktivitasKerjaCtrl extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
    	$aktifitas = AktifitasKerja::all();
    	
    	return view('rencana_kerja.AktifitasKerjaList')->with('aktifitas',$aktifitas);
    }

    public function create($value=''){
    	return view('rencana_kerja.AktifitasKerjaAdd');
    }

    public function store(Request $request){
    	try {
    		DB::beginTransaction();
    		$aktifitas = new AktifitasKerja();
    		$aktifitas->aktifitas_kerja = $request->aktifitas_kerja;
    		$aktifitas->keterangan = $request->keterangan;
    		$aktifitas->tgl = Carbon::now();
    		$aktifitas->save();
    		DB::commit();
    	} catch (Exception $e) {
    		DB::rollback();
    	}

    	return redirect('/rencana/aktifitas');
    }

    public function edit($id=''){
    	$aktifitas = AktifitasKerja::find($id);
    	return view('rencana_kerja.AktifitasKerjaEdit')->with('aktifitas',$aktifitas);
    }

    public function update(Request $request,$id){
    	try {
    		DB::beginTransaction();
    		$aktifitas = AktifitasKerja::find($id);
    		$aktifitas->aktifitas_kerja = $request->aktifitas_kerja;
    		$aktifitas->keterangan = $request->keterangan;
    		$aktifitas->tgl = Carbon::now();
    		
    		$aktifitas->save();
    		$aktifitas->touch();
    		DB::commit();
    	} catch (Exception $e) {
    		DB::rollback();
    	}

    	return redirect('/rencana/aktifitas');
    }

    public function destroy($id){
    	$aktifitas = AktifitasKerja::find($id);
    	$aktifitas->delete();
    	return redirect('rencana/aktifitas');
    }
}
