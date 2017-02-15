<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Lib\Statistik;
use Carbon\Carbon;

class WebCtrl extends Controller
{
    public function getVisitor(Request $request){
		$statistik = new Statistik();
		$ip      = $statistik->ip_user();
		$browser = $statistik->browser_user();
		$os      = $statistik->os_user();
		$visitor = $request->cookie('VISITOR');
		$tanggal = date("Ymd");
		$waktu = time();
		$bataswaktu = $waktu - 300;
		// Check bila sebelumnya data pengunjung sudah terrekam
		if (!isset( $visitor )) {
		
			// Masa akan direkam kembali
			// Tujuan untuk menghindari merekam pengunjung yang sama dihari yang sama.
			// Cookie akan disimpan selama 24 jam
			$duration = time()+60*60*24;
		
			// simpan kedalam cookie browser
			//setcookie('VISITOR',$browser,$duration);
			cookie('VISITOR', $browser, $duration);
		
			// SQL Command atau perintah SQL INSERT
			//$sql = "INSERT INTO statistik (ip, os, browser) VALUES ('$ip', '$os', '$browser')";
			$statistik = DB::table('statistik_web')->orderBy('online','DESC')->where('ip',$ip)->where('date_create',$tanggal)->get();
			if (count($statistik) > 0){
				
				DB::table('statistik_web')
				->where('ip', $ip)->where('date_create', $tanggal)
				->update(
					[
						'hits' => $statistik[0]->hits + 1, 
						'online' => $waktu
					]
				);
			}else{
				DB::table('statistik_web')->insert(
					[
						'ip' => $ip, 
						'os' => $os,
						'hits' => 1, 
						'browser' => $browser,
						'online' => $waktu,
						'date_create' => Carbon::now()
					]
				);
			}
			

			// variabel { $db } adalah perwakilan dari koneksi database lihat config.php
			//$query = $db->query($sql);
			return redirect()->intended($this->redirectPathVisitor());
		}
		
	}

	public function getCookie(Request $request){
      $value = $request->cookie('name');
      echo $value;
   	}

   	public function getStatistiklist($value=''){
	   $statistik = DB::table('statistik_web')->get();
	   return view('master.statistikList')->withStatistik($statistik);
   	}

   	public function getPengunjungonline($value=''){
		$bataswaktu = time() - 300;
		$pengunjungonline = \DB::table('statistik_web')->where('online','>',$bataswaktu)->get();
		return count($pengunjungonline);
	}

	public function getHitstoday($value=''){
		$hits = \DB::table('statistik_web')->select('SUM(hits as hitstoday)')->where('date_create',$tanggal)
		->groubBy('date_create')->get();
		return $hits;
	}

	public function redirectPathVisitor(){
        if (property_exists($this, 'redirectPathVisitor')){
            return $this->redirectPathVisitor;
        }

        return property_exists($this, 'redirectToVisitor') ? $this->redirectToVisitor : '/map';
    }
}
