<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use DB;
use App\Lib\Pagging;

class KuesionerCtrl extends Controller{
      public function __construct($value=''){
         $this->middleware('auth');
         $this->table_utama = 'kuesioner_umk';
         $this->_page = new Pagging();
      }
   	public function getIndex($value=''){
   		$kuesioner_satu =  \DB::table('kuesioner_bagian_satu')->get();
   		$kuesioner_dua =  \DB::table('kuesioner_bagian_dua')->get();
   		$kuesioner_tiga =  \DB::table('kuesioner_bagian_tiga')->get();
   		return view('kuesioner')->with('kuesioner_satu',$kuesioner_satu)->with('kuesioner_dua',$kuesioner_dua)->with('kuesioner_tiga',$kuesioner_tiga);
   	}

      public function getIndexVersiDua($value=''){
         if (Gate::check('access.backend')) {
            $kuesioner =  \DB::table('kuesioner_umk')->get();
            return view('master.kuesionerList')->with('kuesioner',$kuesioner);
         }else{
            return response('Anda tidak diijinkan untuk mengakses halaman ini.', 401);
         }
         
      }

      public function custom($value=''){
         
         return DB::table('users')->toSql();
      }

      public function getCaridata($data=''){
         //$data = $_GET['txtsearch'];
         
         if(isset($_GET["page"]))
         $page = (int)$_GET["page"];
         else
         $page = 1;

         $setLimit = 10;
         $pageLimit = ($page * $setLimit) - $setLimit;


         if(!isset($_GET['txtsearch'])){
            $_GET['txtsearch'] = '';
         }
         $data = $_GET['txtsearch'];
         //$data = (isset($_GET['txtsearch']) ? '' : '' ;
         

         $bagian_satu = $this->getSearchCaridata($data,$setLimit,$pageLimit);

         $__page =  $this->displayPaginationBelow($setLimit,$page);

        
         
         return view('kuesioner.caridata')->with('bagian_satu',$bagian_satu)->with('page',$__page);
      }
      public function getSearchCaridata($search ='',$setLimit,$page){
         $sql_kue = '';
         if (is_null($search) || empty($search)) {
            
            $sql_raw = 'SELECT * FROM kuesioner_umk';
            $sql_raw_full = $sql_raw;
            $sql_raw_full_with_limit = $sql_raw_full.' LIMIT '.$page.','.$setLimit;
            
            
            $bagian_satu_with_limit = DB::select(DB::raw($sql_raw_full_with_limit));
            
            session(['sql' => $sql_raw]);

            $profil = $bagian_satu_with_limit;
         }else{
            $sql_raw = 'SELECT * FROM kuesioner_umk';
            $where_raw = 'UPPER(i_1) LIKE '.'"%'.$search.'%"';
            $where_raw2 = 'OR UPPER(i_2) LIKE '.'"%'.$search.'%"';
            $where_raw3 = 'OR UPPER(i_3) LIKE '.'"%'.$search.'%"';
            $sql_raw_full = $sql_raw.' WHERE '.$where_raw.' '.$where_raw2.' '.$where_raw3;
            $sql_raw_full_with_limit = $sql_raw_full.' LIMIT '.$page.','.$setLimit;

            $bagian_satu = DB::select(DB::raw($sql_raw_full));
            $bagian_satu_with_limit = DB::select(DB::raw($sql_raw_full_with_limit));
            session(['sql' => $sql_raw_full]);
            
            $profil = $bagian_satu_with_limit;
 
         }
         
         $str_query = "SELECT COUNT(*) as totalCount FROM(".session('sql').") AS jumlah_per_halaman";
         
         session(['str_query' => $str_query]);
         $jumlah_record = DB::select(DB::raw($str_query));
         session(['jumlah_record' => $jumlah_record[0]->totalCount]);
         
         return $profil;
      }
      public function getProfil($id=''){
         $profil = DB::table('kuesioner_umk')->orderBy('id')->where('id',$id)->first();
         $array_sudahbelum = array('Belum','Sudah');
         return view('kuesioner.profil')->withProfil($profil)->with('sudahbelum',$array_sudahbelum);
      }

      function displayPaginationBelow($per_page,$page){
         $page_url="?";
         //$query = "SELECT COUNT(*) AS totalCount FROM kuesioner_umk";
         $query = session('str_query');
         //$rec = mysql_fetch_array(mysql_query($query));
         $rec = DB::select(DB::raw($query));
         $total = $rec[0]->totalCount;
         $adjacents = "2"; 

         $page = ($page == 0 ? 1 : $page);  
         $start = ($page - 1) * $per_page;                        
         
         $prev = $page - 1;                     
         $next = $page + 1;
           $setLastpage = ceil($total/$per_page);
         $lpm1 = $setLastpage - 1;
         
         $setPaginate = "";
         if($setLastpage > 1)
         {  
            $setPaginate .= "<ul class='pagination pagination-sm no-margin pull-right'>";
                       //$setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2))
            {  
               for ($counter = 1; $counter <= $setLastpage; $counter++)
               {
                  if ($counter == $page)
                     $setPaginate.= "<li><a class='current_page active'>$counter</a></li>";
                  else
                     $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";             
               }
            }
            elseif($setLastpage > 5 + ($adjacents * 2))
            {
               if($page < 1 + ($adjacents * 2))    
               {
                  for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                  {
                     if ($counter == $page)
                        $setPaginate.= "<li><a class='current_page active'>$counter</a></li>";
                     else
                        $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";             
                  }
                  $setPaginate.= "<li><a>...</a></li>";
                  $setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                  $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";     
               }
               elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
               {
                  $setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
                  $setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
                  $setPaginate.= "<li class='dot'><a>...</a></li>";
                  for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                  {
                     if ($counter == $page)
                        $setPaginate.= "<li><a class='current_page active'>$counter</a></li>";
                     else
                        $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";             
                  }
                  $setPaginate.= "<li class='dot'><a>...</a></li>";
                  $setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                  $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";     
               }
               else
               {
                  $setPaginate.= "<li><a href='{$page_url}page=1'>1</a></li>";
                  $setPaginate.= "<li><a href='{$page_url}page=2'>2</a></li>";
                  $setPaginate.= "<li class='dot'><a>...</a></li>";
                  for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
                  {
                     if ($counter == $page)
                        $setPaginate.= "<li><a class='current_page active'>$counter</a></li>";
                     else
                        $setPaginate.= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";             
                  }
               }
            }
            
            if ($page < $counter - 1){ 
               $setPaginate.= "<li><a href='{$page_url}page=$next'>></a></li>";
                   $setPaginate.= "<li><a href='{$page_url}page=$setLastpage'>Akhir</a></li>";
            }else{
               $setPaginate.= "<li><a class='current_page'>></a></li>";
                   $setPaginate.= "<li><a class='current_page'>Akhir</a></li>";
               }

            $setPaginate.= "</ul>\n";     
         }
       
       
           return $setPaginate;
      } 


   	public function getGambaranUmum(){
   		$i_7 = $this->getBagianSatuJmlKaryawan();
   		$json_i_7 = ($i_7);
   		$i_9 = $this->getMempunyaiLegalitasUsaha();
   		$json_i_9 = ($i_9);
   		$i_10 = $this->getLegalitasYangDimiliki();
   		$json_i_10 = ($i_10);
   		$i_12 = $this->getMempunyaiMerkTerdaftar();
   		$json_i_12 = ($i_12);
   		$i_13 = $this->getSudahMempunyaiIjinEdar();
   		$json_i_13 = ($i_13);
   		$pangan = $this->getProdukYangDihasilkan();
   		$json_pangan = ($pangan);

         //Bagian 2
         $ii_2 = $this->getUMKMSudahMenerapkanStandarProduk();
         $json_ii_2 = ($ii_2);
         $ii_3 = $this->getUMKMSudahMenerapkanSistemMutu();
         $json_ii_3 = ($ii_3);
         $ii_3_a = $this->getSistemUMKDiterapkan();
         $json_ii_3_a = ($ii_3_a);
         $ii_4 = $this->getSaudaraProsedurProduktif();
         $json_ii_4 = ($ii_4);
         $ii_6 = $this->getPernahDilakukanLab();
         $json_ii_6 = ($ii_6);
         $ii_7_a = $this->getMemilikiSertifikatSNI();
         $json_ii_7_a = ($ii_7_a);
         $ii_7_b = $this->getMemilikiSertifikatSKP();
         $json_ii_7_b = ($ii_7_b);
         $ii_7_c = $this->getMemilikiSertifikatHalal();
         $json_ii_7_c = ($ii_7_c);
         $ii_7_d = $this->getMemilikiSertifikatLainnya();
         $json_ii_7_d = ($ii_7_d);

         
         


         //Bagian 3
         $iii_1 = $this->getMendapatkanSNI();
         $json_iii_1 = ($iii_1);
         $iii_2_a = $this->getMendapatkanSNIDarimanaInfoSNI();
         $json_iii_2_a = ($iii_2_a);
         $iii_3 = $this->getPemahamanSNI();
         $json_iii_3 = ($iii_3);
         $iii_4 = $this->getDokumenSNI();
         $json_iii_4 = ($iii_4);
         $iii_5 = $this->getPernahMendapatkanSNIDarimanaInfoSNI();
         $json_iii_5 = ($iii_5);
         $iii_6 = $this->getPernahMendapatkanSNIDenganMembayar();
         $json_iii_6 = ($iii_6);
         $iii_7 = $this->getSNIMudahDiUMKM();
         $json_iii_7 = ($iii_7);
         $iii_8 = $this->getMenjadiKendala();
         $json_iii_8 = ($iii_8);
         $iii_10 = $this->getKendalaPengajuanSertifikasiSNI();
         $json_iii_10 = ($iii_10);
         $iii_11 = $this->getNilaiTambahSetelahSertifikasi();
         $json_iii_11 = ($iii_11);

   		
   		
   		return view('gambaranumum')
   		->with('i7',$json_i_7)
   		->with('i9',$json_i_9)
   		->with('i10',$json_i_10)
   		->with('i12',$json_i_12)
   		->with('i13',$json_i_13)
   		->with('pangan',$json_pangan)

         ->with('ii_2',$json_ii_2)
         ->with('ii_3',$json_ii_3)
         ->with('ii_3_a',$json_ii_3_a)
         ->with('ii_4',$json_ii_4)
         ->with('ii_6',$json_ii_6)
         ->with('ii_7_a',$json_ii_7_a)
         ->with('ii_7_b',$json_ii_7_b)
         ->with('ii_7_c',$json_ii_7_c)
         ->with('ii_7_d',$json_ii_7_d)
         
         

         ->with('iii_1',$json_iii_1)
         ->with('iii_2_a',$json_iii_2_a)
         ->with('iii_3',$json_iii_3)
         ->with('iii_4',$json_iii_4)
         ->with('iii_5',$json_iii_5)
         ->with('iii_6',$json_iii_6)
         ->with('iii_7',$json_iii_7)
         ->with('iii_8',$json_iii_8)
         ->with('iii_10',$json_iii_10)
         ->with('iii_11',$json_iii_11)

         ;
   	}

   	//Bagian 1

   	public function getBagianSatuJmlKaryawan($value=''){
   		$judul = 'Jumlah karyawan';
   		$i7 = array();
   		$i7_1_4 = \DB::table($this->table_utama)
   			->select('i_7')
   			->where('i_7', '>=', 1)
   			->where('i_7', '<=', 4)
   			->count();
   		$i7_5_19 = \DB::table($this->table_utama)
   			->select('i_7')
   			->where('i_7', '>=', 5)
   			->where('i_7', '<=', 19)
   			->count();
   		$i7_20_99 = \DB::table($this->table_utama)
   			->select('i_7')
   			->where('i_7', '>=', 20)
   			->where('i_7', '<=', 99)
   			->count();
   		$i7_lebih_100 = \DB::table($this->table_utama)
   			->select('i_7')
   			->where('i_7', '>=', 100)
   			->count();

   		$i7_total = ($i7_1_4+$i7_5_19+$i7_20_99+$i7_lebih_100);
   		$i7_array = array($i7_1_4,$i7_5_19,$i7_20_99,$i7_lebih_100);
         $tambah=array();
         $info = array('1-4','5-9','20-99','Lebih 100');
   		for ($i=0; $i < 4; $i++) { 
   			$i7['hasil'][$i]['frekuensi'] = $i7_array[$i];
   			$i7['hasil'][$i]['presentase'] = number_format(($i7_array[$i]/$i7_total)*100,2);
            array_push($tambah, number_format(($i7_array[$i]/$i7_total)*100,2)) ;
   		}
         $i7['judul'] = $judul;
         $i7['data'] = $tambah;
         $i7['kategori'] = $info;
   		return $i7;
   	}

   	public function getMempunyaiLegalitasUsaha($value=''){
   		$judul = 'Apakah UMKM sudah mempunyai legalitas usaha';

   		$i9 = array();
   		$i9_belum = \DB::table($this->table_utama)
   			->select('i_9')
   			->where('i_9',0)
   			->count();
   		$i9_sudah = \DB::table($this->table_utama)
   			->select('i_9')
   			->where('i_9', 1)
   			->count();
   
   		$i9_total = ($i9_belum+$i9_sudah);
   		$i9_array = array($i9_belum,$i9_sudah);
         $info = array('Belum','Sudah');
         $tambah =array();
   		for ($i=0; $i < 2; $i++) { 
   			$i9['hasil'][$i]['frekuensi'] = $i9_array[$i];
   			$i9['hasil'][$i]['presentase'] = number_format(($i9_array[$i]/$i9_total)*100,2);
            
            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($i9_array[$i]/$i9_total)*100,2);
   		}
         $i9['judul'] = $judul;
         $i9['data'] = $tambah;
         $i9['kategori'] = $info;
   		return $i9;

   	}

   	public function getLegalitasYangDimiliki($value=''){
   		$judul = 'Legalitas yang Dimiliki';

   		$i10 = array();
   		$i10_tdp = \DB::table($this->table_utama)
   			->select('i_10')
   			->where('i_10',1)
   			->count();
   		$i10_iui = \DB::table($this->table_utama)
   			->select('i_10')
   			->where('i_10', 2)
   			->count();
   		$i10_lainnya = \DB::table($this->table_utama)
   			->select('i_10')
   			->where('i_10', 3)
   			->count();
   
   		$i10_total = ($i10_tdp+$i10_iui+$i10_lainnya);
   		$i10_array = array($i10_tdp,$i10_iui,$i10_lainnya);
         $tambah=array();
         $info = array('TDP','IUI','Lainya');
   		for ($i=0; $i < count($i10_array); $i++) { 
   			$i10['hasil'][$i]['frekuensi'] = $i10_array[$i];
   			$i10['hasil'][$i]['presentase'] = number_format(($i10_array[$i]/$i10_total)*100,2);
            array_push($tambah, number_format(($i10_array[$i]/$i10_total)*100,2)) ;
   		}
         $i10['judul'] = $judul;
         $i10['data'] = $tambah;
         $i10['kategori'] = $info;

   		return $i10;

   	}

   	public function getMempunyaiMerkTerdaftar($value=''){
   		$judul = 'Apakah Produk yang dihasilkan sudah mempunyai Merk yang terdaftar di Kementerian Hukum dan HAM';

   		$i12 = array();
   		$i12_belum = \DB::table($this->table_utama)
   			->select('i_12')
   			->where('i_12',0)
   			->count();
   		$i12_sudah = \DB::table($this->table_utama)
   			->select('i_12')
   			->where('i_12', 1)
   			->count();
   		
   
   		$i12_total = ($i12_belum+$i12_sudah);
   		$i12_array = array($i12_belum,$i12_sudah);
         $tambah=array();
         $info = array('Belum','Sudah');
   		for ($i=0; $i < count($i12_array); $i++) { 
   			$i12['hasil'][$i]['frekuensi'] = $i12_array[$i];
   			$i12['hasil'][$i]['presentase'] = number_format(($i12_array[$i]/$i12_total)*100,2);
            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($i12_array[$i]/$i12_total)*100,2);
   		}
         $i12['judul'] = $judul;
         $i12['data'] = $tambah;
         $i12['kategori'] = $info;

   		return $i12;

   	}

   	public function getSudahMempunyaiIjinEdar($value=''){
   		$judul = 'Apabila produk Saudara sudah mempunyai ijin edar?';

   		$i13 = array();
   		$i13_belum = \DB::table($this->table_utama)
   			->select('i_13')
   			->where('i_13',0)
   			->count();
   		$i13_sudah = \DB::table($this->table_utama)
   			->select('i_13')
   			->where('i_13', 1)
   			->count();
   		
   
   		$i13_total = ($i13_belum+$i13_sudah);
   		$i13_array = array($i13_belum,$i13_sudah);
         $tambah=array();
         $info = array('Belum','Sudah');
   		for ($i=0; $i < count($i13_array); $i++) { 
   			$i13['hasil'][$i]['frekuensi'] = $i13_array[$i];
   			$i13['hasil'][$i]['presentase'] = number_format(($i13_array[$i]/$i13_total)*100,2);
            
            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($i13_array[$i]/$i13_total)*100,2);

   		}
         $i13['judul'] = $judul;
         $i13['data'] = $tambah;
         $i13['kategori'] = $info;

   		return $i13;
   	}

   	public function getProdukYangDihasilkan(){
   		$judul = 'Jenis produk apa yang saudara hasilkan?';

   		$pangan = array();
   		$pangan_p = \DB::table($this->table_utama)
   			->select('jenis_umk')
   			->where('jenis_umk','P')
   			->count();
   		$pangan_n = \DB::table($this->table_utama)
   			->select('jenis_umk')
   			->where('jenis_umk', 'N')
   			->count();
   		
   
   		$pangan_total = ($pangan_p+$pangan_n);
   		$pangan_array = array($pangan_p,$pangan_n);
         $tambah=array();
         $info = array('Pangan','Non Pangan');
   		for ($i=0; $i < count($pangan_array); $i++) { 
   			$pangan['hasil'][$i]['frekuensi'] = $pangan_array[$i];
   			$pangan['hasil'][$i]['presentase'] = number_format(($pangan_array[$i]/$pangan_total)*100,2);
            
            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($pangan_array[$i]/$pangan_total)*100,2);
   		}
         $pangan['judul'] = $judul;
         $pangan['data'] = $tambah;
         $pangan['kategori'] = $info;

   		return $pangan;

   	}

      //Bagian 2

      public function getUMKMSudahMenerapkanStandarProduk($value=''){
         $judul = 'Apakah UMKM  Saudara sudah menerapkan Standar untuk produk?';

         $ii_2 = array();
         $ii_2_belum = \DB::table($this->table_utama)
            ->select('ii_2')
            ->where('ii_2',0)
            ->count();
         $ii_2_sudah = \DB::table($this->table_utama)
            ->select('ii_2')
            ->where('ii_2', 1)
            ->count();
         
   
         $ii_2_total = ($ii_2_belum+$ii_2_sudah);

         $ii_2_array = array($ii_2_belum,$ii_2_sudah);
         $info = array('Belum','Sudah');
         $tambah = array();
         for ($i=0; $i < count($ii_2_array); $i++) { 
            $ii_2['hasil'][$i]['frekuensi'] = $ii_2_array[$i];
            $ii_2['hasil'][$i]['presentase'] = number_format(($ii_2_array[$i]/$ii_2_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($ii_2_array[$i]/$ii_2_total)*100,2);
         }
         $ii_2['judul'] = $judul;
         $ii_2['data'] = $tambah;
         $ii_2['kategori'] = $info;

         return $ii_2; 
      }

      public function getUMKMSudahMenerapkanSistemMutu($value=''){
         $judul = 'Apakah UMK  Saudara sudah menerapkan sistem mutu yang diterapkan?';

         $ii_3 = array();
         $ii_3_belum = \DB::table($this->table_utama)
            ->select('ii_3')
            ->where('ii_3',0)
            ->count();
         $ii_3_sudah = \DB::table($this->table_utama)
            ->select('ii_3')
            ->where('ii_3', 1)
            ->count();
         
   
         $ii_3_total = ($ii_3_belum+$ii_3_sudah);

         $ii_3_array = array($ii_3_belum,$ii_3_sudah);
         $info = array('Belum','Sudah');
         $tambah = array();
         for ($i=0; $i < count($ii_3_array); $i++) { 
            $ii_3['hasil'][$i]['frekuensi'] = $ii_3_array[$i];
            $ii_3['hasil'][$i]['presentase'] = number_format(($ii_3_array[$i]/$ii_3_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($ii_3_array[$i]/$ii_3_total)*100,2);
         }
         $ii_3['judul'] = $judul;
         $ii_3['data'] = $tambah;
         $ii_3['kategori'] = $info;

         return $ii_3; 
      }

      public function getSistemUMKDiterapkan($value=''){
         $judul = 'Sistem UMK yang Diterapkan';

         $ii_3_a = array();
         $ii_3_sni_9001 = \DB::table($this->table_utama)
            ->select('ii_3_a')
            ->where('ii_3_a',1)
            ->count();
         $ii_3_sistem_HACCP = \DB::table($this->table_utama)
            ->select('ii_3_b')
            ->where('ii_3_b', 1)
            ->count();
         $ii_3_tqm = \DB::table($this->table_utama)
            ->select('iii_2_c')
            ->where('ii_3_c', 1)
            ->count();
         $ii_3_sni_14k = \DB::table($this->table_utama)
            ->select('ii_3_d')
            ->where('ii_3_d', 1)
            ->count();
         $ii_3_lain = \DB::table($this->table_utama)
            ->select('ii_3_e')
            ->where('ii_3_e', 1)
            ->count();
         
   
         $ii_3_a_total = ($ii_3_sni_9001+$ii_3_sistem_HACCP+$ii_3_tqm+$ii_3_sni_14k+$ii_3_lain);

         $ii_3_a_array = array($ii_3_sni_9001,$ii_3_sistem_HACCP,$ii_3_tqm,$ii_3_sni_14k,$ii_3_lain);
         $info = array('Sistem Manajemen Mutu SNI ISO 9001','Sistem HACCP','Total Quality Management (TQM)','Sistem Manajemen Lingkungan SNI ISO 14000','Lainnya');
         $tambah = array();
         for ($i=0; $i < count($ii_3_a_array); $i++) { 
            $ii_3_a['hasil'][$i]['frekuensi'] = $ii_3_a_array[$i];
            $ii_3_a['hasil'][$i]['presentase'] = number_format(($ii_3_a_array[$i]/$ii_3_a_total)*100,2);

            array_push($tambah, number_format(($ii_3_a_array[$i]/$ii_3_a_total)*100,2)) ;
         }
         $ii_3_a['judul'] = $judul;
         $ii_3_a['data'] = $tambah;
         $ii_3_a['kategori'] = $info;

         return $ii_3_a;
      }

      public function getSaudaraProsedurProduktif($value=''){
         $judul = 'Apakah UMK Saudara sudah mempunyai prosedur proses produksi?';

         $ii_4 = array();
         $ii_4_belum = \DB::table($this->table_utama)
            ->select('ii_4')
            ->where('ii_4',0)
            ->count();
         $ii_4_sudah = \DB::table($this->table_utama)
            ->select('ii_4')
            ->where('ii_4', 1)
            ->count();
         
   
         $ii_4_total = ($ii_4_belum+$ii_4_sudah);

         $ii_4_array = array($ii_4_belum,$ii_4_sudah);
         $info = array('Belum','Sudah');
         $tambah = array();
         for ($i=0; $i < count($ii_4_array); $i++) { 
            $ii_4['hasil'][$i]['frekuensi'] = $ii_4_array[$i];
            $ii_4['hasil'][$i]['presentase'] = number_format(($ii_4_array[$i]/$ii_4_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($ii_4_array[$i]/$ii_4_total)*100,2);
         }
         $ii_4['judul'] = $judul;
         $ii_4['data'] = $tambah;
         $ii_4['kategori'] = $info;

         return $ii_4; 
      }

      public function getPernahDilakukanLab($value=''){
         $judul = 'Apakah produk yang dihasilkan pernah dilakukan pengujian di laboratorium? ';

         $ii_6 = array();
         $ii_6_belum = \DB::table($this->table_utama)
            ->select('ii_6')
            ->where('ii_6',0)
            ->count();
         $ii_6_sudah = \DB::table($this->table_utama)
            ->select('ii_6')
            ->where('ii_6', 1)
            ->count();
         
   
         $ii_6_total = ($ii_6_belum+$ii_6_sudah);

         $ii_6_array = array($ii_6_belum,$ii_6_sudah);
         $info = array('Belum','Sudah');
         $tambah = array();
         for ($i=0; $i < count($ii_6_array); $i++) { 
            $ii_6['hasil'][$i]['frekuensi'] = $ii_6_array[$i];
            $ii_6['hasil'][$i]['presentase'] = number_format(($ii_6_array[$i]/$ii_6_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($ii_6_array[$i]/$ii_6_total)*100,2);
         }
         $ii_6['judul'] = $judul;
         $ii_6['data'] = $tambah;
         $ii_6['kategori'] = $info;

         return $ii_6; 
      }

      public function getMemilikiSertifikatSNI($value=''){
         $judul = 'Memiliki Sertifikat SNI ';

         $ii_7_a = array();
         $ii_7_a_belum = \DB::table($this->table_utama)
            ->select('ii_7_a')
            ->where('ii_7_a',0)
            ->count();
         $ii_7_a_sudah = \DB::table($this->table_utama)
            ->select('ii_7_a')
            ->where('ii_7_a', 1)
            ->count();
         
   
         $ii_7_a_total = ($ii_7_a_belum+$ii_7_a_sudah);

         $ii_7_a_array = array($ii_7_a_belum,$ii_7_a_sudah);
         $info = array('Belum','Sudah');
         $tambah = array();
         for ($i=0; $i < count($ii_7_a_array); $i++) { 
            $ii_7_a['hasil'][$i]['frekuensi'] = $ii_7_a_array[$i];
            $ii_7_a['hasil'][$i]['presentase'] = number_format(($ii_7_a_array[$i]/$ii_7_a_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($ii_7_a_array[$i]/$ii_7_a_total)*100,2);
         }
         $ii_7_a['judul'] = $judul;
         $ii_7_a['data'] = $tambah;
         $ii_7_a['kategori'] = $info;

         return $ii_7_a; 
      }

      public function getMemilikiSertifikatSKP($value=''){
         $judul = 'Memiliki Sertifikasi Sertifikat Kelayakan Pengolahan (SKP)';
         $ii_7_b = array();
         $ii_7_b_belum = \DB::table($this->table_utama)
            ->select('ii_7_b')
            ->where('ii_7_b',0)
            ->count();
         $ii_7_b_sudah = \DB::table($this->table_utama)
            ->select('ii_7_b')
            ->where('ii_7_b', 1)
            ->count();
         
   
         $ii_7_b_total = ($ii_7_b_belum+$ii_7_b_sudah);

         $ii_7_b_array = array($ii_7_b_belum,$ii_7_b_sudah);
         $info = array('Belum','Sudah');
         $tambah = array();
         for ($i=0; $i < count($ii_7_b_array); $i++) { 
            $ii_7_b['hasil'][$i]['frekuensi'] = $ii_7_b_array[$i];
            $ii_7_b['hasil'][$i]['presentase'] = number_format(($ii_7_b_array[$i]/$ii_7_b_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($ii_7_b_array[$i]/$ii_7_b_total)*100,2);
         }
         $ii_7_b['judul'] = $judul;
         $ii_7_b['data'] = $tambah;
         $ii_7_b['kategori'] = $info;

         return $ii_7_b;
      }

      public function getMemilikiSertifikatHalal($value=''){
         $judul = 'Memiliki Sertifikasi Halal';
         $ii_7_c = array();
         $ii_7_c_belum = \DB::table($this->table_utama)
            ->select('ii_7_c')
            ->where('ii_7_c',0)
            ->count();
         $ii_7_c_sudah = \DB::table($this->table_utama)
            ->select('ii_7_c')
            ->where('ii_7_c', 1)
            ->count();
         
   
         $ii_7_c_total = ($ii_7_c_belum+$ii_7_c_sudah);

         $ii_7_c_array = array($ii_7_c_belum,$ii_7_c_sudah);
         $info = array('Belum','Sudah');
         $tambah = array();
         for ($i=0; $i < count($ii_7_c_array); $i++) { 
            $ii_7_c['hasil'][$i]['frekuensi'] = $ii_7_c_array[$i];
            $ii_7_c['hasil'][$i]['presentase'] = number_format(($ii_7_c_array[$i]/$ii_7_c_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($ii_7_c_array[$i]/$ii_7_c_total)*100,2);
         }
         $ii_7_c['judul'] = $judul;
         $ii_7_c['data'] = $tambah;
         $ii_7_c['kategori'] = $info;

         return $ii_7_c;
      }

      public function getMemilikiSertifikatLainnya($value=''){
         $judul = 'Memiliki Sertifikasi Lainnya';
         $ii_7_d = array();
         $ii_7_d_belum = \DB::table($this->table_utama)
            ->select('ii_7_d')
            ->where('ii_7_d',0)
            ->count();
         $ii_7_d_sudah = \DB::table($this->table_utama)
            ->select('ii_7_d')
            ->where('ii_7_d', 1)
            ->count();
         
   
         $ii_7_d_total = ($ii_7_d_belum+$ii_7_d_sudah);

         $ii_7_d_array = array($ii_7_d_belum,$ii_7_d_sudah);
         $info = array('Belum','Sudah');
         $tambah = array();
         for ($i=0; $i < count($ii_7_d_array); $i++) { 
            $ii_7_d['hasil'][$i]['frekuensi'] = $ii_7_d_array[$i];
            $ii_7_d['hasil'][$i]['presentase'] = number_format(($ii_7_d_array[$i]/$ii_7_d_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($ii_7_d_array[$i]/$ii_7_d_total)*100,2);
         }
         $ii_7_d['judul'] = $judul;
         $ii_7_d['data'] = $tambah;
         $ii_7_d['kategori'] = $info;

         return $ii_7_d;
      }

      public function getSertifikasiYangDimiliki($value=''){
         $judul = 'Sertifikasi apa saja yang sudah dimiliki?';

         $ss = array();
         $ss['judul'] = $judul;
         return $ss;
      }

      public function getUMKmendapatSNI($value=''){
         $judul = 'Apakah UMK Saudara sudah pernah mendapat bimbingan penerapan SNI oleh instansi pemerintah atau swasta lainnya?';
         $ii_8 = array();
         $ii_8_belum = \DB::table($this->table_utama)
            ->select('ii_8')
            ->where('ii_8',0)
            ->count();
         $ii_8_sudah = \DB::table($this->table_utama)
            ->select('ii_8')
            ->where('ii_8', 1)
            ->count();
         
   
         $ii_8_total = ($ii_8_belum+$ii_8_sudah);

         $ii_8_array = array($ii_8_belum,$ii_8_sudah);
         $info = array('Belum','Sudah');
         $tambah = array();
         for ($i=0; $i < count($ii_8_array); $i++) { 
            $ii_8['hasil'][$i]['frekuensi'] = $ii_8_array[$i];
            $ii_8['hasil'][$i]['presentase'] = number_format(($ii_8_array[$i]/$ii_8_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($ii_8_array[$i]/$ii_8_total)*100,2);
         }
         $ii_8['judul'] = $judul;
         $ii_8['data'] = $tambah;
         $ii_8['kategori'] = $info;

         return $ii_8;
      }

      public function FunctionName($value='')
      {
         $judul = 'Jika sudah mendapatkan bimbingan, apakah bentuk bimbingan tersebut di atas memberikan manfaat? ';
      }

      

   	//Bagian 3

   	public function getMendapatkanSNI($value=''){
   		$judul = 'Apakah Saudara sudah pernah mendapatkan informasi mengenai Standar Nasional Indonesia (SNI)?';

         $iii_1 = array();
         $iii_1_belum = \DB::table($this->table_utama)
            ->select('iii_1')
            ->where('iii_1',0)
            ->count();
         $iii_1_sudah = \DB::table($this->table_utama)
            ->select('iii_1')
            ->where('iii_1', 1)
            ->count();
         
   
         $iii_1_total = ($iii_1_belum+$iii_1_sudah);

         $iii_1_array = array($iii_1_belum,$iii_1_sudah);
         $info = array('Belum','Sudah');
         $tambah = array();
         for ($i=0; $i < count($iii_1_array); $i++) { 
            $iii_1['hasil'][$i]['frekuensi'] = $iii_1_array[$i];
            $iii_1['hasil'][$i]['presentase'] = number_format(($iii_1_array[$i]/$iii_1_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($iii_1_array[$i]/$iii_1_total)*100,2);
         }
         $iii_1['judul'] = $judul;
         $iii_1['data'] = $tambah;
         $iii_1['kategori'] = $info;

         return $iii_1;
   	}

      public function getMendapatkanSNIDarimanaInfoSNI($value=''){
         $judul = 'Jika Sudah Mendapatkan informasi produk, dari mana mendapatkan informasi tentang SNI tersebut?  ';

         $iii_2_a = array();
         $iii_2_internet = \DB::table($this->table_utama)
            ->select('iii_2_a')
            ->where('iii_2_a',1)
            ->count();
         $iii_2_layanan_bsn = \DB::table($this->table_utama)
            ->select('iii_2_b')
            ->where('iii_2_b', 1)
            ->count();
         $iii_2_layanan_dinas = \DB::table($this->table_utama)
            ->select('iii_2_c')
            ->where('iii_2_c', 1)
            ->count();
         $iii_2_balai = \DB::table($this->table_utama)
            ->select('iii_2_d')
            ->where('iii_2_d', 1)
            ->count();
         $iii_2_lain = \DB::table($this->table_utama)
            ->select('iii_2_e')
            ->where('iii_2_e', 1)
            ->count();
         
   
         $iii_2_a_total = ($iii_2_internet+$iii_2_layanan_bsn+$iii_2_layanan_dinas+$iii_2_balai+$iii_2_lain);

         $iii_2_a_array = array($iii_2_internet,$iii_2_layanan_bsn,$iii_2_layanan_dinas,$iii_2_balai,$iii_2_lain);
         $info = array('Internet','Layanan BSN','Dinas Setempat','Balai/Lembaga Lain','Lainnya');
         $tambah = array();
         for ($i=0; $i < count($iii_2_a_array); $i++) { 
            $iii_2_a['hasil'][$i]['frekuensi'] = $iii_2_a_array[$i];
            $iii_2_a['hasil'][$i]['presentase'] = number_format(($iii_2_a_array[$i]/$iii_2_a_total)*100,2);

            array_push($tambah, number_format(($iii_2_a_array[$i]/$iii_2_a_total)*100,2)) ;
         }
         $iii_2_a['judul'] = $judul;
         $iii_2_a['data'] = $tambah;
         $iii_2_a['kategori'] = $info;

         return $iii_2_a;
      }

      public function getPemahamanSNI(){
         $judul = 'Bagaimana pemahaman Saudara terhadap SNI';

         $iii_3 = array();
         $iii_3_dipahami = \DB::table($this->table_utama)
            ->select('iii_3')
            ->where('iii_3',1)
            ->count();
         $iii_3_sulitdipahami = \DB::table($this->table_utama)
            ->select('iii_3')
            ->where('iii_3', 2)
            ->count();
         $iii_3_tidaktahu = \DB::table($this->table_utama)
            ->select('iii_3')
            ->where('iii_3', 3)
            ->where('iii_3', 0)
            ->count();
         
   
         $iii_3_total = ($iii_3_dipahami+$iii_3_sulitdipahami+$iii_3_tidaktahu);

         $iii_3_array = array($iii_3_dipahami,$iii_3_sulitdipahami,$iii_3_tidaktahu);
         $info = array('Dipahami','Sulit Dipahami','Tidak Tahu');
         $tambah = array();
         for ($i=0; $i < count($iii_3_array); $i++) { 
            $iii_3['hasil'][$i]['frekuensi'] = $iii_3_array[$i];
            $iii_3['hasil'][$i]['presentase'] = number_format(($iii_3_array[$i]/$iii_3_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($iii_3_array[$i]/$iii_3_total)*100,2);
         }
         $iii_3['data'] = $tambah;
         $iii_3['kategori'] = $info;

         return $iii_3;

      }

      public function getDokumenSNI($value=''){
         $judul = 'Apakah Saudara sudah pernah mendapatkan dokumen  Standar Nasional Indonesia (SNI)?';

         $iii_4 = array();
         $iii_4_belum = \DB::table($this->table_utama)
            ->select('iii_4')
            ->where('iii_4',0)
            ->count();
         $iii_4_sudah = \DB::table($this->table_utama)
            ->select('iii_4')
            ->where('iii_4', 1)
            ->count();
         
   
         $iii_4_total = ($iii_4_belum+$iii_4_sudah);

         $iii_4_array = array($iii_4_belum,$iii_4_sudah);
         $info = array('Belum','Sudah');
         $tambah = array();
         for ($i=0; $i < count($iii_4_array); $i++) { 
            $iii_4['hasil'][$i]['frekuensi'] = $iii_4_array[$i];
            $iii_4['hasil'][$i]['presentase'] = number_format(($iii_4_array[$i]/$iii_4_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($iii_4_array[$i]/$iii_4_total)*100,2);
         }
         $iii_4['judul'] = $judul;
         $iii_4['data'] = $tambah;
         $iii_4['kategori'] = $info;

         return $iii_4;
      }

      public function getPernahMendapatkanSNIDarimanaInfoSNI($value=''){
         $judul = 'Jika sudah pernah mendapatkan dokumen SNI, dari mana mendapatkan dokumen SNI? ';

         $iii_5 = array();
         $iii_5_layanan_bsn = \DB::table($this->table_utama)
            ->select('iii_5_a')
            ->where('iii_5_a',1)
            ->count();
         $iii_5_lembaga = \DB::table($this->table_utama)
            ->select('iii_5_b')
            ->where('iii_5_b', 1)
            ->count();
         $iii_5_layanan_dinas = \DB::table($this->table_utama)
            ->select('iii_5_c')
            ->where('iii_5_c', 1)
            ->count();
         $iii_5_lain = \DB::table($this->table_utama)
            ->select('iii_5_d')
            ->where('iii_5_d', 1)
            ->count();
         
         
   
         $iii_5_a_total = ($iii_5_layanan_bsn+$iii_5_lembaga+$iii_5_layanan_dinas+$iii_5_lain);

         $iii_5_a_array = array($iii_5_layanan_bsn,$iii_5_lembaga,$iii_5_layanan_dinas,$iii_5_lain);
         $info = array('Layanan BSN','Lembaga','Dinas','Lainnya');
         $tambah = array();
         for ($i=0; $i < count($iii_5_a_array); $i++) { 
            $iii_5['hasil'][$i]['frekuensi'] = $iii_5_a_array[$i];
            $iii_5['hasil'][$i]['presentase'] = number_format(($iii_5_a_array[$i]/$iii_5_a_total)*100,2);

            array_push($tambah, number_format(($iii_5_a_array[$i]/$iii_5_a_total)*100,2)) ;
         }
         $iii_5['judul'] = $judul;
         $iii_5['data'] = $tambah;
         $iii_5['kategori'] = $info;

         return $iii_5;
      }

      public function getPernahMendapatkanSNIDenganMembayar($value=''){
         $judul = 'Jika Saudara sudah pernah mendapatkan dokumen SNI dengan membayar, menurut Saudara, harga dokumen SNI tersebut:';


         $iii_6 = array();
         $iii_6_mahal = \DB::table($this->table_utama)
            ->select('iii_6')
            ->where('iii_6',1)
            ->count();
         $iii_6_murah = \DB::table($this->table_utama)
            ->select('iii_6')
            ->where('iii_6', 2)
            ->count();
         $iii_6_biasa = \DB::table($this->table_utama)
            ->select('iii_6')
            ->where('iii_6', 3)
            ->count();
         $iii_6_tidaktahu = \DB::table($this->table_utama)
            ->select('iii_6')
            ->where('iii_6', 4)
            ->count();
         
   
         $iii_6_total = ($iii_6_mahal+$iii_6_murah+$iii_6_biasa+$iii_6_tidaktahu);

         $iii_6_array = array($iii_6_mahal,$iii_6_murah,$iii_6_biasa,$iii_6_tidaktahu);
         $info = array('Mahal','Murah','Biasa Saja','Tidak Tahu');
         $tambah = array();
         for ($i=0; $i < count($iii_6_array); $i++) { 
            $iii_6['hasil'][$i]['frekuensi'] = $iii_6_array[$i];
            $iii_6['hasil'][$i]['presentase'] = number_format(($iii_6_array[$i]/$iii_6_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($iii_6_array[$i]/$iii_6_total)*100,2);
         }
         $iii_6['judul'] = $judul;
         $iii_6['data'] = $tambah;
         $iii_6['kategori'] = $info;

         return $iii_6;
      }

      public function getSNIMudahDiUMKM($value=''){
         $judul = 'Menurut Saudara, apakah SNI mudah diterapkan di UMKM Saudara?';

         $iii_7 = array();
         $iii_7_tidak = \DB::table($this->table_utama)
            ->select('iii_7')
            ->where('iii_7',0)
            ->count();
         $iii_7_ya = \DB::table($this->table_utama)
            ->select('iii_7')
            ->where('iii_7', 1)
            ->count();
     
         
   
         $iii_7_total = ($iii_7_tidak+$iii_7_ya);

         $iii_7_array = array($iii_7_tidak,$iii_7_ya);
         $info = array('Tidak','Ya');
         $tambah = array();
         for ($i=0; $i < count($iii_7_array); $i++) { 
            $iii_7['hasil'][$i]['frekuensi'] = $iii_7_array[$i];
            $iii_7['hasil'][$i]['presentase'] = number_format(($iii_7_array[$i]/$iii_7_total)*100,2);

            $tambah[$i]['name'] = $info[$i];
            $tambah[$i]['y'] = number_format(($iii_7_array[$i]/$iii_7_total)*100,2);
         }
         $iii_7['judul'] = $judul;
         $iii_7['data'] = $tambah;
         $iii_7['kategori'] = $info;

         return $iii_7;

      }

      public function getMenjadiKendala($value='')
      {
         $judul = 'Jika tidak mudah diterapkan, apa yang menjadi kendala dalam penerapannya?';

         $iii_8 = array();
         $iii_8_rumit = \DB::table($this->table_utama)
            ->select('iii_8_a')
            ->where('iii_8_a',1)
            ->count();
         $iii_8_diperlukanbiaya = \DB::table($this->table_utama)
            ->select('iii_8_b')
            ->where('iii_8_b', 1)
            ->count();
         $iii_8_sdm_terbatas = \DB::table($this->table_utama)
            ->select('iii_8_c')
            ->where('iii_8_c', 1)
            ->count();
         $iii_8_lain = \DB::table($this->table_utama)
            ->select('iii_8_d')
            ->where('iii_8_d', 1)
            ->count();
         
         
   
         $iii_8_total = ($iii_8_rumit+$iii_8_diperlukanbiaya+$iii_8_sdm_terbatas+$iii_8_lain);

         $iii_8_array = array($iii_8_rumit,$iii_8_diperlukanbiaya,$iii_8_sdm_terbatas,$iii_8_lain);
         $info = array('Rumit','Diperlukan Biaya','Kemampuan SDM terbatas','Lainnya');
         $tambah = array();
         for ($i=0; $i < count($iii_8_array); $i++) { 
            $iii_8['hasil'][$i]['frekuensi'] = $iii_8_array[$i];
            $iii_8['hasil'][$i]['presentase'] = number_format(($iii_8_array[$i]/$iii_8_total)*100,2);

            array_push($tambah, number_format(($iii_8_array[$i]/$iii_8_total)*100,2)) ;
         }
         $iii_8['judul'] = $judul;
         $iii_8['data'] = $tambah;
         $iii_8['kategori'] = $info;

         return $iii_8;
      }

      public function getKendalaPengajuanSertifikasiSNI($value='')
      {
         $judul = 'Apa kendala dalam pengajuan sertifikasi SNI?';

         $iii_10 = array();
         $iii_10_biaya = \DB::table($this->table_utama)
            ->select('iii_10_a')
            ->where('iii_10_a',1)
            ->count();
         $iii_10_prosedur = \DB::table($this->table_utama)
            ->select('iii_10_b')
            ->where('iii_10_b', 1)
            ->count();
         $iii_10_tidakada = \DB::table($this->table_utama)
            ->select('iii_10_c')
            ->where('iii_10_c', 1)
            ->count();
         $iii_10_lain = \DB::table($this->table_utama)
            ->select('iii_10_d')
            ->where('iii_10_d', 1)
            ->count();

         $iii_10_total = ($iii_10_biaya+$iii_10_prosedur+$iii_10_tidakada+$iii_10_lain);

         $iii_10_array = array($iii_10_biaya,$iii_10_prosedur,$iii_10_tidakada,$iii_10_lain);
         $info = array('Biaya Mahal','Prosedur Tidak Jelas','Tidak Ada Lembaga Sertifikasi','Lainnya');
         $tambah = array();
         for ($i=0; $i < count($iii_10_array); $i++) { 
            $iii_10['hasil'][$i]['frekuensi'] = $iii_10_array[$i];
            $iii_10['hasil'][$i]['presentase'] = number_format(($iii_10_array[$i]/$iii_10_total)*100,2);

            array_push($tambah, number_format(($iii_10_array[$i]/$iii_10_total)*100,2)) ;
         }
         $iii_10['judul'] = $judul;
         $iii_10['data'] = $tambah;
         $iii_10['kategori'] = $info;

         return $iii_10;
      }

      public function getNilaiTambahSetelahSertifikasi($value='')
      {
         $judul = 'Menurut Saudara, apa nilai tambah bagi UMKM Saudara setelahmendapat sertifikasi?';
         $iii_11 = array();
         $iii_11_omzet = \DB::table($this->table_utama)
            ->select('iii_11_a')
            ->where('iii_11_a',1)
            ->count();
         $iii_11_mudah = \DB::table($this->table_utama)
            ->select('iii_11_b')
            ->where('iii_11_b', 1)
            ->count();
         $iii_11_proses = \DB::table($this->table_utama)
            ->select('iii_11_c')
            ->where('iii_11_c', 1)
            ->count();
         $iii_11_efesien = \DB::table($this->table_utama)
            ->select('iii_11_d')
            ->where('iii_11_d', 1)
            ->count();
         $iii_11_belum = \DB::table($this->table_utama)
            ->select('iii_11_e')
            ->where('iii_11_e', 1)
            ->count();
         $iii_11_lain = \DB::table($this->table_utama)
            ->select('iii_11_f')
            ->where('iii_11_f', 1)
            ->count();

         $iii_11_total = ($iii_11_omzet+$iii_11_mudah+$iii_11_proses+$iii_11_efesien+$iii_11_belum+$iii_11_lain);

         $iii_11_array = array($iii_11_omzet,$iii_11_mudah,$iii_11_proses,$iii_11_efesien,$iii_11_belum,$iii_11_lain);

         $info = array('Omzet Meningkat','Mudah Dikenal','Proses Produksi Menjadi Teratur','Efisien','Belum Ada Manfaatnya','Lainnya');
         $tambah = array();
         for ($i=0; $i < count($iii_11_array); $i++) { 
            $iii_11['hasil'][$i]['frekuensi'] = $iii_11_array[$i];
            $iii_11['hasil'][$i]['presentase'] = number_format(($iii_11_array[$i]/$iii_11_total)*100,2);

            array_push($tambah, number_format(($iii_11_array[$i]/$iii_11_total)*100,2)) ;
         }
         $iii_11['judul'] = $judul;
         $iii_11['data'] = $tambah;
         $iii_11['kategori'] = $info;

         return $iii_11;
      }
       
}
