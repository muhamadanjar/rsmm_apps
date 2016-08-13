<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RKCtrl;
use Illuminate\Http\Request;

class ReportCtrl extends Controller {
	

	public function __construct(){
		$this->middleware('auth.admin');
		$this->ctrlRK = new RKCtrl();
	}

	public function ReportMaster(Request $request){

		$users_core = $this->ctrlRK->getUsers();
		$users = $this->ctrlRK->getUsers();
		return view('rencana.reportMaster')->with('users',$users_core);
	}

	public function index(){
		$users = $this->getUsers();
		
		return view('master.report')->with('users',$users);
	}

	public function postRekapHarian(Request $request){

		$this->validate($request, [
	        'daritgl' => 'required',
	        'sampaitgl' => 'required',
	    ]);
		$users_core = $this->ctrlRK->getUsers();
		$daritgl = $request->daritgl;$sampaitgl = $request->sampaitgl;
	    if($request != null){
			$users = $this->getUsers($request->users);
		}else{
			$users = $this->getUsers();
		}

		$tgl = $this->ctrlRK->getTglLoop($daritgl,$sampaitgl);
		
		$users_ = array();$hariantgl = array();

		for ($i=0; $i < count($users); $i++) { 

			$users_[$i] = $users[$i];
			for($ti =0;$ti<count($tgl);$ti++ ){
				$harian = \App\RKHarian::
					where('tgl','=',$tgl[$ti])
					->where('user_id','=',$users[$i]->id)
					->orderBy('tgl','ASC')
					->orderBy('darijam','ASC')->get();
			
				$hariantgl[$ti]['tgl'] = $tgl[$ti];
				$hariantgl[$ti]['hariantgl'] = $harian;
				
			}
			$users_[$i]['harian'] = $hariantgl;
		}

		$rekap = $users_;

		\Session::put('ReportStore', $rekap);

		return view('rencana.reportMaster')->with('users',$users_core)->withRekap($rekap);
	}

	public function indexHarianMingguan(){
		$users = $this->getUsers();
		
		return view('master.reportHarianMingguan')->with('users',$users);
	}

	public function getUsers($id=''){
		if (empty($id)) {
			$users = \App\User::where('username','!=','admin')->orderBy('id','ASC')->get(); 
		}else{
			$users = \App\User::where('username','!=','admin')->where('id','=',$id)->orderBy('id','ASC')->get(); 	
		}
		
		return $users;

	}

	public function getTglDis($dari='',$sampai=''){
		$whereBetween ='';
		if ($dari != null || $sampai != null) {

			$whereBetween = "WHERE tgl BETWEEN '".$dari."' AND '".$sampai."'";
		}
		return \App\RKHarian::select('tgl')->distinct('tgl')
		->whereRaw("tgl in (SELECT tgl FROM rk_harian ".$whereBetween.")")->get();
	}

	public function postRekap(Request $request){

		$this->validate($request, [
	        'daritgl' => 'required',
	        'sampaitgl' => 'required',
	    ]);

		$tgl = $this->getTglDis($request->daritgl,$request->sampaitgl);
		
		if ($request->pengguna != 'all') {
			
			$users = $this->getusers($request->pengguna);
			$rekap =\App\RKHarian::join('users',function($join){
				$join->on('rk_harian.user_id', '=', 'users.id');
			})
			->orderby('rk_harian.created_at','ASC')
			->whereBetween('rk_harian.tgl', array($request->daritgl, $request->sampaitgl) )
			->whereRaw('user_id = ?',array($request->pengguna))
			->get();	
		}else{
			$users = $this->getusers();
			$rekap =\App\RKHarian::join('users',function($join){
				$join->on('rk_harian.user_id', '=', 'users.id');
			})->orderby('rk_harian.created_at','ASC')
			->whereBetween('rk_harian.tgl', array($request->daritgl, $request->sampaitgl) )
			->get();	
		}
		

		\Session::put('ReportStore', $rekap);
		\Session::put('users', $users);
		\Session::put('tgl', $tgl);

		return view('master.report')->with('users',$users)->with('rekap',$rekap)->with('tgl',$tgl);
	}

	public function postRekapHM(Request $request){

		$this->validate($request, [
	        'daritgl' => 'required',
	        'sampaitgl' => 'required',
	    ]);

		$tgl = $this->getTglDis($request->daritgl,$request->sampaitgl);
		
		if ($request->pengguna != 'all') {
			
			$users = $this->getusers($request->pengguna);
			$rekap =\App\RKHarian::join('users',function($join){
				$join->on('rk_harian.user_id', '=', 'users.id');
			})->join('rk_minggu',function ($join){
				$join->on('rk_harian.user_id', '=', 'rk_minggu.id');
			})
			->orderby('rk_harian.created_at','ASC')
			->whereBetween('rk_harian.tgl', array($request->daritgl, $request->sampaitgl) )
			->whereRaw('rk_harian.user_id = ?',array($request->pengguna))
			->get();	
		}else{
			$users = $this->getusers();
			$rekap =\App\RKHarian::join('users',function($join){
				$join->on('rk_harian.user_id', '=', 'users.id');
			})->join('rk_minggu',function ($join){
				$join->on('rk_harian.user_id', '=', 'rk_minggu.id');
			})
			->orderby('rk_harian.created_at','ASC')
			->whereBetween('rk_harian.tgl', array($request->daritgl, $request->sampaitgl) )
			->get();	
		}
		

		\Session::put('ReportStore', $rekap);
		\Session::put('users', $users);
		\Session::put('tgl', $tgl);

		return view('master.report')->with('users',$users)->with('rekap',$rekap)->with('tgl',$tgl);
	}

	public function getTgl(){
		return \App\RKHarian::select('tgl')->groupby('tgl')->orderBy('tgl')->get();
	}

	public function getuser(){
		return \App\User::orderBy('id','ASC')->get();
	}

	public function ReportExcel($namafile){
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		

		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		$objPHPExcel = new \PHPExcel();
		$kotbogor = \Session::get('ReportStore');
		//dd($kotbogor);
		//dd(Session::all());
		$BorderstyleArray = array(
			'borders' => array(
			    'allborders' => array(
			      'style' => \PHPExcel_Style_Border::BORDER_THIN
			    )
			)
		);

		$ColorstyleArray = array(
	        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
	        'startcolor' => array(
	             'rgb' => 'F28A8C'
	        )
	    );

		/*$objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
	        'type' => PHPExcel_Style_Fill::FILL_SOLID,
	        'startcolor' => array(
	             'rgb' => $color
	        )
	    ));*/
		
		$objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('B2', 'Laporan RTH Kota Bogor');
	    $objPHPExcel->getActiveSheet()->getStyle("B2")->getFont()->setSize(16);

		// Setting Ukuran
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		

		// Setting Gambar
		$objDrawing = new \PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('Logo');
		$objDrawing->setDescription('Logo');
		$logo = 'images/rsmm.png'; // Provide path to your logo file
		$objDrawing->setPath($logo);  //setOffsetY has no effect
		$objDrawing->setCoordinates('A1');
		$objDrawing->setHeight(80); // logo height
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 

		//Setting Style
		$objPHPExcel->getActiveSheet()->getStyle('A5:E5')->applyFromArray($BorderstyleArray);
		$objPHPExcel->getActiveSheet()->getStyle('A5:E5')->getFill()->applyFromArray($ColorstyleArray);

		$objPHPExcel->getProperties()->setCreator("Administrator")
							 ->setLastModifiedBy("Administrator")
							 ->setTitle("Laporan Kerja RSMMM")
							 ->setSubject("Kerja Harian")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("rth kotabogor office 2007 openxml php")
							 ->setCategory("rth");
		// Add some data
		$posHeader = 5;
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A'.$posHeader, 'Rencana Harian')
		            ->setCellValue('B'.$posHeader, 'Aktifitas')
		            ->setCellValue('C'.$posHeader, 'Dari Jam')
		            ->setCellValue('D'.$posHeader, 'Sampai Jam')
		            ->setCellValue('E'.$posHeader, 'Keterangan');
		$pos = $posHeader + 1;
		foreach ($kotbogor as $key => $v) {
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$pos,	$v->rencanaharian)
		            ->setCellValue('B'.$pos, html_entity_decode($v->aktifitas))
		            ->setCellValue('C'.$pos, 	$v->darijam)
		            ->setCellValue('D'.$pos, 	$v->sampaijam)
		            ->setCellValue('E'.$pos, 	$v->keterangan);
		            
		            $pos += 1; 
		}
		//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$pos,'Total');
		//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$pos,\Session::get('total'));


		$objPHPExcel->getActiveSheet()->getStyle('A5:E'.($pos-1))->applyFromArray($BorderstyleArray);

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Laporan Kerja');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		$this->Excel2003($namafile);

		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		//$objWriter->save($namafile.'.xls');
		$request->session()->forget('ReportStore');
		$request->session()->forget('total');
		
	}

	public function ReportExcel_rencanakerjaharian($namafile=''){
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);

		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		$objPHPExcel = new \PHPExcel();

		$report = \Session::get('ReportStore');
		$users = \Session::get('users');
		$tgl = \Session::get('tgl');

		$objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('B2', 'Laporan Rencana Kerja Realsoft Media');
	    $objPHPExcel->getActiveSheet()->getStyle("B2")->getFont()->setSize(16);

		// Setting Ukuran
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);

		


		$posUser = 5;
		
		foreach ($users as $ukey => $uv) {
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$posUser,'Nama')
				->setCellValue('B'.$posUser,":")
				->setCellValue('C'.$posUser,$uv->name);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$posUser.':E'.$posUser)->applyFromArray($this->BorderstyleOutline());
			$objPHPExcel->getActiveSheet()->getStyle('A'.$posUser.':E'.$posUser)->getFill()->applyFromArray($this->Colorstyle('D9EDF7'));
			$objPHPExcel->getActiveSheet()->getStyle('A'.$posUser.':E'.$posUser)->getFont()->setBold(true);
			
			$postgl = $posUser + 1;
			foreach ($tgl as $key => $tv) {
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$postgl,\AHelper::tgl_indo($tv->tgl));
				$objPHPExcel->getActiveSheet()->getStyle('A'.$postgl.':E'.$postgl)->getFill()->applyFromArray($this->Colorstyle('00AAFF'));
				$objPHPExcel->getActiveSheet()->getStyle('A'.$postgl)->getFont()->setItalic(true);
				
				$posHeader = $postgl + 1;

				$objPHPExcel->getActiveSheet()->getStyle('A'.$posHeader.':E'.$posHeader)->applyFromArray($this->Borderstyle());
				$objPHPExcel->getActiveSheet()->getStyle('A'.$posHeader.':E'.$posHeader)->getFont()->setBold(true);

				$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A'.$posHeader, 'Rencana Harian')
		            ->setCellValue('B'.$posHeader, 'Aktifitas')
		            ->setCellValue('C'.$posHeader, 'Dari Jam')
		            ->setCellValue('D'.$posHeader, 'Sampai Jam')
		            ->setCellValue('E'.$posHeader, 'Keterangan');
		        $objPHPExcel->getActiveSheet()->getRowDimension($posHeader)->setRowHeight(40);
		        $objPHPExcel->getActiveSheet()->getStyle('A'.$posHeader.':E'.$posHeader)->applyFromArray($this->HorizontalVerticalCenter());

		            $pos = $posHeader + 1;
		            foreach ($report as $key => $vr) {
		            	if($vr->id == $uv->id){
		            		if($vr->tgl == $tv->tgl){
		            			$objPHPExcel->setActiveSheetIndex(0)
						            ->setCellValue('A'.$pos, $vr->rencanaharian)
						            ->setCellValue('B'.$pos, $vr->aktifitas)
						            ->setCellValue('C'.$pos, $vr->darijam)
						            ->setCellValue('D'.$pos, $vr->sampaijam)
						            ->setCellValue('E'.$pos, $vr->keterangan);
						        $objPHPExcel->getActiveSheet()->getStyle('A'.$pos.':E'.$pos)->applyFromArray($this->Borderstyle());
						        $pos += 1;		
		            		}
		            	}
		            	
		            }
		            $posHeader = $pos;
		        
		       
				$postgl = $posHeader;
				$postgl += 1;
			}
			$posUser = $postgl;
			$posUser += 1;
			
			 
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Laporan Kerja');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		$this->Excel2003($namafile);

		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		//$objWriter->save($namafile.'.xls');
		$request->session()->forget('ReportStore');
		$request->session()->forget('tgl');
		$request->session()->forget('users');

	}

	public function reportnilai($namafile='Laporan Kerja Harian'){
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		$objPHPExcel = new \PHPExcel();
		
		$objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('B2', 'Laporan Rencana Kerja Realsoft Media');
	    $objPHPExcel->getActiveSheet()->getStyle("B2")->getFont()->setSize(16);

		// Setting Ukuran
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$data = $this->ctrlRK->getNilaiMingguan();

		$posUser = 5;

		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A4','Nama')
				->setCellValue('B4', 'Dari Tanggal')
		    	->setCellValue('C4', 'Sampai Tanggal')
				->setCellValue('E4', 'Bobot Per Minggu');
		$objPHPExcel->getActiveSheet()
					->getStyle('A4:E4')
					->getFill()->applyFromArray($this->Colorstyle('D9EDF7'));
		$objPHPExcel->getActiveSheet()
					->getStyle('A4:E4')
					->applyFromArray($this->Borderstyle());
		$objPHPExcel->getActiveSheet()
					->getStyle('A4:E4')
					->getFont()->setBold(true);
					
		foreach($data as $k => $v){
			
			if(isset($v['minggu'])){
				foreach($v['minggu'] as $k2 => $v2){
					if(!isset($v2['daritgl'])){
					
					}else{
					$objPHPExcel->getActiveSheet()
					->getStyle('A'.$posUser.':E'.$posUser)
						->applyFromArray($this->Borderstyle());

					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$posUser, $v['name'])
						->setCellValue('B'.$posUser, \AHelper::tgl_indo($v2['daritgl']))
						->setCellValue('C'.$posUser, \AHelper::tgl_indo($v2['sampaitgl']))
						->setCellValue('E'.$posUser, $v2['bobot_minggu']);
						$posMingguan = $posUser+1;
						foreach($v2['tgl'] as $k3 => $v3){
							$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('D'.$posMingguan, \AHelper::tgl_indo($v3['tgl']))
								->setCellValue('E'.$posMingguan, $v3['bobot_harian']);
							$objPHPExcel->getActiveSheet()
							->getStyle('A'.$posMingguan.':E'.$posMingguan)
							->applyFromArray($this->Borderstyle());

							$posMingguan += 1;
						}
						$posUser = $posMingguan;
						$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$posUser, 'Total Per Minggu')
							->setCellValue('E'.$posUser, $v2['bobot_minggu']);
						
					$posUser += 1;
					}
				}
			}
			
			
		}
		
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Laporan Kerja');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		$this->Excel2003($namafile);

		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}
	


	//Excel Function--------------------------------------------------------------------
	
	public function Excel2003($namafile){
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$namafile.'.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
	}

	public function Excel2007($namafile){
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$namafile.'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
	}

	public function Borderstyle(){
		$BorderstyleArray = array(
			'borders' => array(
			    'allborders' => array(
			      'style' => \PHPExcel_Style_Border::BORDER_THIN
			    )
			)
		);

		return $BorderstyleArray;
	}

	public function BorderstyleOutline(){
		$BorderstyleOutline = array(
		  	'borders' => array(
		    	'outline' => array(
		      		'style' => \PHPExcel_Style_Border::BORDER_THIN
		    	)
		  	)
		);

		return $BorderstyleOutline;
	}

	public function Colorstyle($value='F28A8C'){
		$ColorstyleArray = array(
	        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
	        'startcolor' => array(
	             'rgb' => $value
	        )
	    );
	    return $ColorstyleArray;
	}

	public function HorizontalVerticalCenter($value=''){
		$style = array(
	        'alignment' => array(
	            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	            'vertical' =>  \PHPExcel_Style_Alignment::VERTICAL_CENTER,
	        )

	    );

	    return $style;
	}

	
}
