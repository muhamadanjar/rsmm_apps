<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

use App\Lib\AHelper;

class RKCtrl extends Controller {

	public function __construct(){
		/*$this->middleware('auth.admin',	['except'	=>	[
			'mingguanindex','mingguancreate','mingguanstore','mingguanedit','mingguandelete',
			'harianindex','harianedit','mingguanstore','mingguanedit','mingguandelete'
			]
		]);*/
		$this->middleware('auth');
		$this->ahelper = new AHelper();
		//$this->middleware('kerja.expired',['except'=> ['index','mingguancreate','harianindex','mingguanindex']]);
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
		$users = $this->getUsers();
		return view('rencana.index')->with('users',$users);
	}

	public function mingguanindex(){

		if (Auth::user()->hasRole('admin')) {
			$mingguan = \App\RKMinggu::select(['rk_minggu.*','users.name'])->join('users',function ($join){
				$join->on('rk_minggu.user_id','=','users.id');
			})->orderBy('daritgl','ASC')
			->orderBy('created_at','ASC')->get();
		}else{
			$mingguan = \App\RKMinggu::select(['rk_minggu.*','users.name'])->join('users',function ($join){
				$join->on('rk_minggu.user_id','=','users.id');
			})->where('user_id',array(\Auth::user()->id))
			->orderBy('created_at','ASC')->get();
		}
		
		$status = 'add';
		$users = $this->getUsers();
		return view('rencana.kerjamingguan')->with('mingguan',$mingguan)->with('status',$status)->with('users',$users);
	}
	
	public function mingguancreate(){
		$status = 'add';

		return view('rencana.kerjamingguan')->with('status',$status);
	}

	public function mingguanstore(Request $request){

		//$qlayer = ($request->id == null) ? new \App\RKMinggu : \App\RKMinggu::find($request->id);
		if ($request->status =='edit') {
			$qlayer = \App\RKMinggu::find($request->id);
			$rm = $qlayer;
			$rm->daritgl = $request->daritgl;
			$rm->sampaitgl = $request->sampaitgl;
			$rm->rencanamingguan = $request->rencanamingguan;
			$rm->user_id = $request->user_id;
			$rm->save();
		}else{
			if (\App\RKMinggu::where('daritgl', '=', $request->daritgl)
				->where('sampaitgl', '=', $request->sampaitgl)
				->where('user_id', '=', \Auth::user()->id)->exists() ) {
			   	return redirect('/rencanakerja/mingguan')->with('messageError','Data Sudah di input');
			}else{
				$qlayer = new \App\RKMinggu;
			   	$rm = $qlayer;
				$rm->daritgl = $request->daritgl;
				$rm->sampaitgl = $request->sampaitgl;
				$rm->rencanamingguan = $request->rencanamingguan;
				$rm->user_id = $request->user_id;
				$rm->save();
				
			}
			
		}

		return redirect('/rencanakerja/harian');

	}

	public function mingguanedit($id){
		$status = 'edit';
		$rencanakerjamingguan = \App\RKMinggu::find($id);
		$users = $this->getUsers();

		return view('rencana.kerjamingguan')->with('rkmingguan',$rencanakerjamingguan)
		->with('users',$users)
		->with('status',$status);
	}

	public function mingguandelete($id){
		$rm = \App\RKMinggu::find($id);
		$rm->delete();

		return redirect('/rencanakerja/mingguan');
	}



	//==================================Harian============================================//


	public function harianindex(){
		if (Auth::user()->hasRole('admin')) {
			$harian = \App\RKHarian::select(['rk_harian.*','users.name'])->join('users',function ($join){
				$join->on('rk_harian.user_id','=','users.id');
			})->orderBy('tgl','DESC')
			->orderBy('darijam','ASC')->get();
		}else{
			$harian = \App\RKHarian::select(['rk_harian.*','users.name'])->join('users',function ($join){
				$join->on('rk_harian.user_id','=','users.id');
			})
			->where('user_id',array(\Auth::user()->id))
			->orderBy('tgl','ASC')
			->orderBy('darijam','ASC')->get();	
		}
		
		$day = date('w');
		$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
		$week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
		
		$minggu = \App\RKMinggu::select('id')->where('daritgl','>=',$week_start)
		->where('sampaitgl','<=',$week_end)
		->first();
		

		$users = $this->getUsers();
		return view('rencana.kerjaharian')->with('harian',$harian)
		->with('users',$users)->with('minggu',$minggu);
	}

	public function harianedit($id){
		$rencanakerjaharian = \App\RKHarian::find($id);
		$users = $this->getUsers();
	
		return view('rencana.kerjaharian')->with('rkharian',$rencanakerjaharian)->with('users',$users);
		
	}

	public function harianstore(Request $request){
		
		if(date('Y-m-d') > $request->tgl){

			return redirect('rencanakerja/harian')
				->with('messageError', 'Batas Waktu telah habis untuk menambahkan data tersebut');
				
		}else{
			
			$qlayer = ($request->id == null) ? new \App\RKHarian : \App\RKHarian::find($request->id);
			$rh = $qlayer;
			$rh->rencanaharian = $request->rencanaharian;
			$rh->darijam = $request->darijam;
			$rh->sampaijam = $request->sampaijam;
			$rh->aktifitas = $request->aktifitas;
			$rh->aktifitas_darijam = $request->aktifitas_darijam;
			$rh->aktifitas_sampaijam = $request->aktifitas_sampaijam;
			$rh->keterangan = $request->keterangan;
			$rh->user_id = $request->user_id;
			$rh->mingguan_id = $request->minggu_id;
			$rh->tgl = $request->tgl;
			$rh->status = $request->status;
			$rh->save();

		}
		
		return redirect('/rencanakerja/harian');
	}

	public function hariandelete($id){
		$rh = \App\RKHarian::find($id);
		$rh->delete();

		return redirect('/rencanakerja/harian');
	}
	
	public function harianeditajax(Request $request){
		$task = \App\RKHarian::find($request->harianid);
		$task->bobot = $request->bobot;
	
		$task->save();
		return \Response::json($task);
	}


	//=====================Penilaian Bobot=================================//
	
	
	public function analisisHarian(){
		$users_ = $this->getAnalisisHarian();
		$users_core = $this->getUsers();
		$katakunci = \DB::table('katakunci')->lists('kata');

		return view('rencana.analisisharian')
		->with('userharian',$users_)
		->with('users',$users_core);
	}
	
	public function analisis_harian_view_post(Request $request){
		$users_core = $this->getUsers();
		$users_ = $this->getAnalisisHarian($request);

		return view('rencana.analisisharian')
		->with('userharian',$users_)
		->with('users',$users_core);
	}
	
	public function analisisMingguan(Request $request){
		$mingguan = $this->getAnalisisMingguan();
		$users_core = $this->getUsers();
		//dd($mingguan);
		return view('rencana.analisismingguan')
		->with('users',$users_core)
		->with('mingguan',$mingguan);
		
	}
	
	public function analisisBulanan(){
		$bulanan = $this->getAnalisisBulanan();
		$users_core = $this->getUsers();
		//dd($bulanan);
		return view('rencana.analisisbulanan')
		->with('users',$users_core)
		->with('bulanan',$bulanan);
	}
	
	
	//=====================Lihat nilai=====================================================//
	
	public function nilaiHarian(Request $request){
		$users_core = $this->getUsers();
		
		$users_harian = $this->getNilai();
		
		$series = array();
		foreach($users_harian as $kuh => $vuh){
			$total_user = 0;
			$series['name'] = 'Rencana Kerja'.$vuh['users'];
			$series['colorByPoint'] = true;
			if(isset($vuh['tgl_user'])){
				$total_tgl = count($vuh['tgl_user']);$total_nilai_user = $total_tgl*100;
				foreach($vuh['tgl_user'] as $k){
					$total_user += $k['nilai'];
				}
				$series['data'][$kuh]['name'] = $vuh['users'];
				$series['data'][$kuh]['y'] = $total_user;
			}

			
		}
		return view ('rencana.lihatnilai')
		->with('userharian',$users_harian)
		->with('users',$users_core)
		->with('series',$series);	
	}
	
	public function nilaiMingguan(Request $request){
		$users_core = $this->getUsers();
		$nilai = $this->getNilaiMingguan($request);
		
		return view('rencana.lihatnilaimingguan')->with('nilai',$nilai)
		->with('users',$users_core);
	}
	
	
	//==================================Tambahan==================================================//
	
	public function getAnalisis($request = ''){
		if($request != null){
			$users = $this->getUsers($request->users);
		}else{
			$users = $this->getUsers();
		}

		$tgl = $this->getTglDis();
		
		$users_ = array();
		for ($i=0; $i < count($users); $i++) { 
			$users_[$i] = $users[$i];
			$users_[$i]['harian'] = $this->getHarian($users[$i]['id']);
		}
		
		return $users_;
	}
	
	public function getAnalisisHarian(){
		$analisis = $this->getAnalisis();
		
		foreach($analisis as $k => $v){
			foreach($v->harian as $k2 => $v2){
				$total_rencanakerja_tgl = count($v2->hariantgl);
				$ttt = 0;
				foreach($v2->hariantgl as $k3 => $v3){
					if($v3->status == 1){
						$ttt += 1;
					}
				}
				$nilai = ($ttt/$total_rencanakerja_tgl)*100;
				$v2->nilaiharian = $nilai;
			}
		}
		
		return ($analisis);
	}
	
	public function getAnalisisMingguan($request = ''){
		if($request != null){
			$users = $this->getUsers($request->users);
		}else{
			$users = $this->getUsers();
		}
		
		$day = date('w');
		$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
		$week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));

		$users_mingguan = array();$users_harian = array();
		
		for ($i=0; $i < count($users); $i++) {
			$minggu = \App\RKMinggu::where('user_id','=',$users[$i]->id)->get();
			$minggu_arr = array();
			
			foreach($minggu as $k => $v){
				$tgl = $this->getTglLoop($v->daritgl,$v->sampaitgl);
				$hariantgl = array();
				$nilai_prestasi = 0;
				$jumlah_hari = count($tgl);
				$nilai_hari_tterlaksana = array();$nilai_hari_terlaksana = array();
				$jumlah_baris_rencana = 0;$jumlah_baris_realasisasi = 0;
				$jumlah_jam_perminggu = 0;
				for($ti =0;$ti<$jumlah_hari;$ti++ ){
					$harian = \App\RKHarian::
					where('tgl',$tgl[$ti])
					->where('user_id','=',$users[$i]->id)
					->orderBy('tgl','ASC')
					->orderBy('darijam','ASC')->get();
					$total_rencana = count($harian); 
					if($total_rencana > 0){
						$ttt = 0;
						$jam = 0;
						foreach($harian as $k2 =>$v3){
							$jumlah_baris_rencana += 1;
							$jam += $this->getHours($v3->aktifitas_darijam,$v3->aktifitas_sampaijam);
							if($v3->status == 1){
								$ttt += 1;
								$jumlah_baris_realasisasi += 1;
							}
						}
						$nilai = ($ttt/$total_rencana)*100;
						
						if($jam > 8 ){
							$jam = 8;
						}
						
						$hariantgl[$ti]['nilaiharian'] = $nilai;
						$hariantgl[$ti]['jumlahaktifitasjam'] = $jam;
						$jumlah_jam_perminggu += $jam;
						
						$nilai_harian_jam = ($jam/8)*100;
						$hariantgl[$ti]['nilaiaktifitasjam'] = $nilai_harian_jam;
						
						$nilai_hari_terlaksana[$ti] = $nilai;
						$nilai_hari_tterlaksana[$ti] = (100 - $nilai);
						
						$nilai_prestasi += $nilai/$jumlah_hari;
			
					}else{
						$nilai_hari_terlaksana[$ti] = 0;
						$nilai_hari_tterlaksana[$ti] = (100 - 0);
						$hariantgl[$ti]['nilaiharian'] = 0;
						
						$hariantgl[$ti]['jumlahaktifitasjam'] = 0;
						
						$hariantgl[$ti]['nilaiaktifitasjam'] = 0;
					}
					$hariantgl[$ti]['tgl'] = $tgl[$ti];					
					$hariantgl[$ti]['hariantgl'] = $harian;
					
					$v->harian = $hariantgl;
				
				}
				
				$v->nilaimingguan = $nilai_prestasi;
				$v->jumlah_baris_rencana = $jumlah_baris_rencana;
				$v->jumlah_baris_realasisasi = $jumlah_baris_realasisasi;
				$v->jumlah_jam_perminggu = $jumlah_jam_perminggu;
				
				$nilai_prestasiv2 = ($jumlah_baris_realasisasi/$jumlah_baris_rencana)*100;
				$v->nilaimingguanv2 = $nilai_prestasiv2;
				$nilai_jam_perminggu = ($jumlah_jam_perminggu/40)*100;
				$v->nilai_jam_perminggu = $nilai_jam_perminggu;
				$v->nilai_hari_terlaksana = $nilai_hari_terlaksana;
				$v->nilai_hari_tterlaksana = $nilai_hari_tterlaksana;
				
				$target = ($nilai_jam_perminggu * 0.2) + ($nilai_prestasiv2 * 0.8);
				$target_rata_rata = ($nilai_jam_perminggu * 0.2) + ($nilai_prestasi * 0.8);
				$v->nilai_gabungan = $target;
				$v->nilai_gabungan_rata_rata = $target_rata_rata;
				$nilaistatus = $this->getNilaiStatus($target);
				$v->nilai_status = $nilaistatus;
				
				$nilairataratastatus = $this->getNilaiStatus($target_rata_rata);
				$v->nilairataratastatus = $nilairataratastatus;
				
				$minggu_arr[$k] = $v;
			}
			
			$users_mingguan[$i] = $users[$i];
			$users_mingguan[$i]['mingguan'] = $minggu_arr;
			
		}
		
		//dd($users_mingguan);
		return $users_mingguan;
		
	}
	
	public function getAnalisisBulanan($request = ''){
		if($request != null){
			$users = $this->getUsers($request->users);
		}else{
			$users = $this->getUsers();
		}

		$users_bulanan = array();$users_harian = array();
		for ($i=0; $i < count($users); $i++) {
			
			$bulan_arr = array(); 
			$bulan = $this->ahelper->getBulanArray();
			foreach($bulan as $kb => $vb){
				
				$bulan_arr[$kb]['kode'] = $kb;
				$bulan_arr[$kb]['bulan'] = $vb;
				
				$minggu = \App\RKMinggu::where('user_id','=',$users[$i]->id)
							->whereRaw('EXTRACT(MONTH FROM daritgl) = ?',array($kb))->get();
				$minggu_arr = array();
				$jumlah_baris_rencana = 0;$jumlah_baris_realasisasi = 0;$jumlah_jam_perminggu = 0;$bulan_rata_rata = 0;
				foreach($minggu as $k => $v){
					$tgl = $this->getTglLoop($v->daritgl,$v->sampaitgl);
					$hariantgl = array();
					$nilai_prestasi = 0;
					$jumlah_hari = count($tgl);
					$nilai_hari_tterlaksana = array();$nilai_hari_terlaksana = array();
					
					for($ti =0;$ti<$jumlah_hari;$ti++ ){
						$harian = \App\RKHarian::
						where('tgl',$tgl[$ti])
						->where('user_id','=',$users[$i]->id)
						->orderBy('tgl','ASC')
						->orderBy('darijam','ASC')->get();
						$total_rencana = count($harian); 
						if($total_rencana > 0){
							$ttt = 0;
							$jam = 0;
							foreach($harian as $k2 =>$v3){
								$jumlah_baris_rencana += 1;
								$jam += $this->getHours($v3->aktifitas_darijam,$v3->aktifitas_sampaijam);
								if($v3->status == 1){
									$ttt += 1;
									$jumlah_baris_realasisasi += 1;
								}
							}
							$nilai = ($ttt/$total_rencana)*100;
							
							if($jam > 8 ){
								$jam = 8;
							}
							
							$hariantgl[$ti]['nilaiharian'] = $nilai;
							$hariantgl[$ti]['jumlahaktifitasjam'] = $jam;
							$jumlah_jam_perminggu += $jam;
							
							$nilai_harian_jam = ($jam/8)*100;
							$hariantgl[$ti]['nilaiaktifitasjam'] = $nilai_harian_jam;
							
							$nilai_hari_terlaksana[$ti] = $nilai;
							$nilai_hari_tterlaksana[$ti] = (100 - $nilai);
							
							$nilai_prestasi += $nilai/$jumlah_hari;
				
						}else{
							$nilai_hari_terlaksana[$ti] = 0;
							$nilai_hari_tterlaksana[$ti] = (100 - 0);
							$hariantgl[$ti]['nilaiharian'] = 0;
							
							$hariantgl[$ti]['jumlahaktifitasjam'] = 0;
							
							$hariantgl[$ti]['nilaiaktifitasjam'] = 0;
						}
						$hariantgl[$ti]['tgl'] = $tgl[$ti];					
						$hariantgl[$ti]['hariantgl'] = $harian;
						
						$v->harian = $hariantgl;
						/*if(count($harian) > 0){
							$hariantgl[$ti] = $tgl[$ti];
							$hariantgl[$ti]['hariantgl'] = $harian;
						}*/					
					}
					
					$v->nilaimingguan = $nilai_prestasi;
					$v->jumlah_baris_rencana = $jumlah_baris_rencana;
					$v->jumlah_baris_realasisasi = $jumlah_baris_realasisasi;
					$v->jumlah_jam_perminggu = $jumlah_jam_perminggu;
					
					$nilai_prestasiv2 = ($jumlah_baris_realasisasi/$jumlah_baris_rencana)*100;
					$v->nilaimingguanv2 =$nilai_prestasiv2;
					$nilai_jam_perminggu = ($jumlah_jam_perminggu/40)*100;
					$v->nilai_jam_perminggu = $nilai_jam_perminggu;
					$v->nilai_hari_terlaksana = $nilai_hari_terlaksana;
					$v->nilai_hari_tterlaksana = $nilai_hari_tterlaksana;
					
					$target = ($nilai_jam_perminggu * 0.2) + ($nilai_prestasiv2 * 0.8);
					$target_rata_rata = ($nilai_jam_perminggu * 0.2) + ($nilai_prestasi * 0.8);
					$v->nilai_gabungan = $target;
					$v->nilai_gabungan_rata_rata = $target_rata_rata;
					$bulan_rata_rata += $target_rata_rata;
					$nilaistatus = $this->getNilaiStatus($target);
					$v->nilai_status = $nilaistatus;
					
					$nilairataratastatus = $this->getNilaiStatus($target_rata_rata);
					$v->nilairataratastatus = $nilairataratastatus;
					
					$minggu_arr[$k] = $v;
				}
				$bulan_rata_rata = $bulan_rata_rata / 4;
				$bulan_arr[$kb]['mingguan'] = $minggu_arr;
				$bulan_arr[$kb]['nilai_rata_rata'] = $bulan_rata_rata;
				$bulan_arr[$kb]['nilai_rata_rata_status'] = $this->getNilaiStatus($bulan_rata_rata);
				
			}
			
			
			$users_bulanan[$i] = $users[$i];
			$users_bulanan[$i]['bulanan'] = $bulan_arr;
			
		}
		
		//dd($users_bulanan);
		return $users_bulanan;
		
	}
	
	
	
	public function getNilai(){
		$users_ = $this->getAnalisis();
		
		$data = [];$data_complete = [];
		
		foreach($users_ as $uh => $k){
			$data[$uh]['users'] = $k->name;
			foreach($k->harian as $uh2 =>$k2){
				$total_rencanakerja_tgl = count($k2->harian);
                $total = 0;$total2 = 0;$bobot = 0;
				
				$data[$uh]['tgl_user'][$uh2]['tgl'] = $k2->tgl;
				foreach($k2->hariantgl as $krh => $vrh){
					$bobot = $vrh->bobot;
                    $total2 = $total2 + $bobot;	
				}
				$data[$uh]['tgl_user'][$uh2]['nilai'] = $total2; 	

			}
			
		}
		
		return ($data); 
	}
	
	public function getNilaiMingguan(){
		$analisis_mingguan = $this->getAnalisisMingguan();
		//dd($analisis_mingguan);
		$data_complete = array();
		foreach($analisis_mingguan as $k => $v){
			$data_complete[$k]['id'] = $v->id;
			$data_complete[$k]['name'] = $v->name;
			
			if(isset($v->mingguan)){
				foreach($v->mingguan as $k2 => $v2){
	 				//$data_complete[$k]['daritgl'] = $v2->daritgl;
					//$data_complete[$k]['sampaitgl'] = $v2->sampaitgl;
					$minggunilai = 0;
					if(isset($v2->harian)){
						$total_hari = count($v2->harian);
						foreach($v2->harian as $k3 => $v3){
							
							$bobot=0;
							
							foreach($v3['hariantgl'] as $k4 => $v4){
								$bobot += $v4->bobot;	
							}
							$data_complete[$k]['minggu'][$k2]['daritgl'] = $v2->daritgl;
							$data_complete[$k]['minggu'][$k2]['sampaitgl'] = $v2->sampaitgl;
							$data_complete[$k]['minggu'][$k2]['tgl'][$k3]['tgl'] = $v3['tgl'];
							$data_complete[$k]['minggu'][$k2]['tgl'][$k3]['bobot_harian'] = $bobot;
							$minggunilai += $bobot;
						}
					}
					$minggunilai = ($minggunilai/$total_hari);
					$data_complete[$k]['minggu'][$k2]['bobot_minggu'] = $minggunilai;
					
					

				}
			}
			
		}
		return $data_complete;
		//dd($data_complete);
	}
	
	public function getHarian($userid='3'){
		$tgl = $this->getTglDis();
		$day = date('w');
		$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
		$week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
		
		$hariantgl = array();
		for ($i=0; $i < count($tgl); $i++) {

			$harian = \App\RKHarian::where('tgl','=',$tgl[$i]->tgl)
				//->whereBetween('rk_harian.tgl',array($week_start,$week_end))
				->where('user_id','=',$userid)
				->orderBy('tgl','ASC')
				->orderBy('darijam','ASC')->get();
			/* membuka semua data terhadap user apapun
			$hariantgl[$i] = $tgl[$i];
			$hariantgl[$i]['harian'] = $harian;
			*/
			if(count($harian) > 0){
				$hariantgl[$i] = $tgl[$i];
				$hariantgl[$i]['hariantgl'] = $harian;
			} 
			
		}

		return $hariantgl;
	}
	
	public function getMingguan($userid='3'){
		$hariantgl = array();
		$tgl = $this->getTglDis();
		
		for ($i=0; $i < count($tgl); $i++) {
			$minggu = \App\RKMinggu::where('user_id','=',$userid)->get();
			if(count($minggu) > 0){
				$hariantgl[$i] = $tgl[$i];
				$hariantgl[$i]['hariantgl'] = $minggu;
			}
		}
			
		/*foreach($minggu as $mk => $mv){
			$hariantgl[$mk]['minggu'] = $mv->daritgl.' - '.$mv->sampaitgl;
			$hariantgl[$mk]['tgl'] = $this->getHarian($userid);

		}*/

		return ($hariantgl);
		//dd($hariantgl);
	}
	
	public function getUsers($id=''){
		if (empty($id)) {
			$users = \App\User::where('username','!=','admin')->orderBy('id','ASC')->get(); 
		}else{
			$users = \App\User::where('username','!=','admin')->where('id','=',$id)->orderBy('id','ASC')->get(); 	
		}
		
		return $users;

	}

	public function checkExpired($date_expired='',$date_now =''){
		if ($date_expired < $date_now) {
			echo 'Udah Lewat broh';
			return redirect('rencanakerja/harian');
		}  
	}

	public function analisis_harian(){
		$data =  \App\RKHarian::select(\DB::raw('count(*) as count,tgl,user_id'))
			->groupBy('tgl')
			->groupBy('user_id')
			->orderBy('tgl','ASC')->get();

		$data2 = \App\RKHarian::join(\DB::raw('(SELECT count(*) as count,rk_harian.tgl,rk_harian.user_id
											FROM rk_harian
										GROUP BY
										rk_harian.tgl,
										rk_harian.user_id) as tbl_tgl_g'),function($join){
			$join->on('rk_harian.user_id','=','tbl_tgl_g.user_id');
		})->get();

		return dd($data2);
	}

	public function getTglDis($dari='',$sampai=''){

		$whereBetween ='';
		if ($dari != null || $sampai != null) {

			$whereBetween = "WHERE tgl BETWEEN '".$dari."' AND '".$sampai."'";
		}
		return \App\RKHarian::select('tgl')->distinct('tgl')
		->whereRaw("tgl in (SELECT tgl FROM rk_harian ".$whereBetween.")")->orderBy('tgl','ASC')->get();
	}
	
	public function getTglLoop($dari='2016-05-22',$sampai='2016-05-28'){
		$begin = new \DateTime( $dari);
		$end   = new \DateTime( $sampai );
		$array = array();
		$ti = 0;
		for($i = $begin; $begin <= $end; $i->modify('+1 day')){
			$array[$ti] =  $i->format("Y-m-d");
			$ti++;
		}
		return $array;
		
			
	}
	
	public function getTglMingguan($dari='2016-05-22',$sampai='2016-05-28'){
		echo $dari;
		$whereBetween ='';
		if ($dari != null || $sampai != null) {

			$whereBetween = "WHERE tgl BETWEEN '".$dari."' AND '".$sampai."'";
		}
		return \App\RKMinggu::whereRaw("tgl in (SELECT tgl FROM rk_harian ".$whereBetween.")")
		->orderBy('tgl','ASC')
		->get();
	}

	public function getHours($from,$to){
		$total      = strtotime($to) - strtotime($from);
		$hours      = floor($total / 60 / 60);
		return $hours;
	}
	
	public function getNilaiStatus($nilai=0){
		if($nilai < 55){
			$status = 'Kurang Baik';	
		}elseif($nilai >= 56 && $nilai <= 65){
			$status = 'Cukup';
		}elseif($nilai >= 66 && $nilai <= 75){
			$status = 'Baik';
		}elseif($nilai >= 76 && $nilai <= 100){
			$status = 'Sangat Baik';
		}
		
		return $status;
	}
}
