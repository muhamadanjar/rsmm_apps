<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RencanaKerja;
use DB;
use Carbon\Carbon;
use Gate;
class RencanaKerjaCtrl extends Controller{
    public function index(){
        $rencana = RencanaKerja::all();
        return view('rencana_kerja.RencanaList')->with('rencana',$rencana);
    }

    public function create($value=''){
        $kode = $this->getKode('C');

        if (Gate::check('create.rencanakerja')) {
            return view('rencana_kerja.RencanaAdd')->with('kode',$kode);
        }
     
        return abort(403,'Anda Tidak Bisa Mengakses Halaman ini.');

        /*if (! $this->authorize('create.rencanakerja')) {
           return "I can't create new user :(";
        }

        return 'Yay! I can access create new user :D';*/
        
    }

    public function edit($id){
        $rencana = RencanaKerja::find($id);
        if (!Gate::check('edit.rencanakerja')) {
            abort(403,'Anda Tidak Bisa Mengakses Halaman ini.');
        }
    	return view('rencana_kerja.RencanaEdit')->with('rencana',$rencana);
    }

    public function store(Request $request){
        $dari_tgl = explode('/', $request->dari_tgl);
        $dari_tgl_c = Carbon::createFromDate($dari_tgl[2], $dari_tgl[1], $dari_tgl[0]);

        $sampai_tgl = explode('/', $request->sampai_tgl);
        $sampai_tgl_c = Carbon::createFromDate($sampai_tgl[2], $sampai_tgl[1], $sampai_tgl[0]);

        try {

            DB::beginTransaction();
            $rencana = new RencanaKerja();
            $rencana->kode_rencana = $request->kode_rencana;
            $rencana->kode_grup_rencana = $request->kode_grup_rencana;
            $rencana->rencana_kerja = $request->rencana_kerja;
            $rencana->dari_tgl = $dari_tgl_c;
            $rencana->sampai_tgl = $sampai_tgl_c;
            $rencana->keterangan = $request->keterangan;
            $rencana->isactive = 1;
            $rencana->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('/rencana/kerja');
    }

    public function update(Request $request,$kerja){

        if (strpos($a, '/') !== false) {
            $dari_tgl = explode('/', $request->dari_tgl);
            $dari_tgl_c = Carbon::createFromDate($dari_tgl[2], $dari_tgl[1], $dari_tgl[0]);

            $sampai_tgl = explode('/', $request->sampai_tgl);
            $sampai_tgl_c = Carbon::createFromDate($sampai_tgl[2], $sampai_tgl[1], $sampai_tgl[0]);
        }else{
            $dari_tgl_c = $request->dari_tgl;
            $sampai_tgl_c = $request->sampai_tgl;
        }
        

        try {
            DB::beginTransaction();
            $rencana = RencanaKerja::find($kerja);
            $rencana->kode_rencana = $request->kode_rencana;
            $rencana->kode_grup_rencana = $request->kode_grup_rencana;
            $rencana->rencana_kerja = $request->rencana_kerja;
            $rencana->dari_tgl = $dari_tgl_c;
            $rencana->sampai_tgl = $sampai_tgl_c;
            $rencana->keterangan = $request->keterangan;
            $rencana->isactive = 1;
            $rencana->save();
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect('/rencana');
    }

    public function destroy($id){
        $rencana = RencanaKerja::find($id);
        if (!Gate::check('delete.rencanakerja')) {
            abort(403,'Anda Tidak Bisa Mengakses Halaman ini.');
        }
        $rencana->delete();
        return redirect('/rencana/kerja');
    }

    public function getData($value=''){
        $data = array();
        $rencana = array();
        $rencana_kerja = RencanaKerja::all();
        foreach ($rencana_kerja as $key => $value) {
            $rencana = $value;
            array_push($data, $rencana);
        }
        $new = array();
        $new['data'] = $data;
        return json_encode($new);
    }

    public function otomatis_kode($awalan,$table,$field){
        $last_rec = \DB::table($table)->orderBy($field,'DESC')
            ->select([DB::raw('('.$field.') AS kodex')])
            ->first($field);
        $kode ='';
        if ($last_rec != null) {
            $kode = $last_rec->kodex;
        }

        $huruf = substr($kode, 0, 1);
        $angka = substr($kode, 1, 1);
        //strpos($kode,$huruf);
        if ($angka == false) {
            $angka = '0';
        }
        $angka++;

        return $awalan.$angka;
    }

    public function getKode($char){
        $kode = $this->otomatis_kode($char,'rencana_kerja','kode_rencana');
        return $kode;
    }
}
