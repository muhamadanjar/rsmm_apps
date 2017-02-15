<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ExcelCtrl extends Controller{

    public function __construct($value=''){
        $this->middleware('auth');
        $this->excel =  new \PHPExcel();
    }
    public function getIndex($value=''){
        return view('excelImport');
    }

    public function postImportExcel(Request $request){
        //dd(public_path("excel.xlsx"));
        // Create new PHPExcel object
        $objPHPExcel = \PHPExcel_IOFactory::load(public_path("excel.xlsx"));
        //$objPHPExcel->setActiveSheetIndex(0)->getActiveSheet();
        
        $dataArr = array();
        
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            //echo 'Worksheet number - ', $objPHPExcel->getIndex($worksheet), PHP_EOL;
            //$index = $objPHPExcel->getWorksheetIterator()->key('Table 2');
            //echo $index;
            $worksheetTitle     = $worksheet->getTitle();
            $highestRow         = $worksheet->getHighestRow(); // e.g. 10
            $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
            $rowbaru = 0;
            for ($row = 1; $row <= $highestRow; ++ $row) {
                for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                    $val = $cell->getCalculatedValue(); //$cell->getValue();
                    $dataArr[$row][$col] = $val;
                }
                $rowbaru++;
            }
        }
        
        return json_encode($dataArr);
    }

    public function getImportExcel2007($file_excel=''){
        $objReader = new \PHPExcel_Reader_Excel2007();
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($file_excel);

        $rowIterator = $objPHPExcel->setActiveSheetIndex(0)->getRowIterator();

        $array_data = array();
        foreach($rowIterator as $row){
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
            if(1 == $row->getRowIndex()) continue;//skip first row
            if(2 == $row->getRowIndex()) continue;//skip first row
            if(3 == $row->getRowIndex()) continue;//skip first row
            if(4 == $row->getRowIndex()) continue;//skip first row
            
            
            $rowIndex = $row->getRowIndex ();
            $array_data[$rowIndex] = array('A'=>'', 'B'=>'','C'=>'','D'=>'');
            
            foreach ($cellIterator as $cell) {
                /*if('A' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                } else if('B' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                } else if('C' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = \PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'YYYY-MM-DD');
                } else if('D' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                } else if('E' == $cell->getColumn()){
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                } else if('F' == $cell->getColumn()){
                    
                    $date ='';
                    $date = $cell->getCalculatedValue();
                    //$value = (isset($value) ? $value:0);
                    $my_date = date('Y-m-d', strtotime($date));
                    $array_data[$rowIndex][$cell->getColumn()] = $my_date;
                }else{
                    $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
                }*/
                $array_data[$rowIndex][$cell->getColumn()] = $cell->getCalculatedValue();
            }
        }
        return $array_data;
    }

    function getSheets() {
        $fileName = public_path("excel.xlsx");
        try {
            $fileType = \PHPExcel_IOFactory::identify($fileName);
            $objReader = \PHPExcel_IOFactory::createReader($fileType);
            $objPHPExcel = $objReader->load($fileName);
            $sheets = [];
            //dd($objPHPExcel->getAllSheets());
            foreach ($objPHPExcel->getAllSheets() as $sheet) {
                $sheets[$sheet->getTitle()] = $sheet->toArray();
            }
            //unset($sheets['Table 1'][0]);unset($sheets['Table 1'][1]);unset($sheets['Table 1'][2]);
            return $sheets;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function QueryBagianSatu($dataArr){
        $array = array('info'=>false);
        try{
            foreach($dataArr as $val){
                \DB::table('kuesioner_bagian_satu_repos')->insert([
                    [
                        'nama_input' => $val['A'],
                        'kode' => $val['B'], 
                        'nomor_kuesioner' => $val['C'],
                        'nomor_bsn' => $val['D'],
                        'nama_surveyor' => $val['E'],
                        'tgl_survey' => date('Y-m-d',strtotime($val['E'])),
                        'propinsi' => $val['G'],
                        'i_1' => $val['H'],
                        'i_2' => $val['I'],
                        'i_3' => $val['J'],
                        'i_4' => $val['K'],
                        'i_5' => $val['L'],
                        'i_6' => $val['M'],
                        'i_7' => $val['N'],
                        'i_8' => $val['O'],
                        'i_9' => $val['P'],
                        'i_10' => $val['Q'],
                        'i_10_a' => $val['R'],
                        'i_10_b' => $val['S'],
                        'i_11' => $val['Z'],
                        'i_11_a' => $val['AA'],
                        'i_12' => $val['AB'],
                        'i_12_a' => $val['AC'],
                        'i_13' => $val['AD'],
                        'i_13_a' => $val['AE'],
                        'i_14' => $val['AF'],
                        'i_15' => $val['AG'],
                        'i_16' => $val['AH'],
                        'jenis_umk' => $val['AI'],
                        
                    ],
                    
                ]);
            }
            $array['info'] = true;
        }catch(Exception $e){
            \DB::rollback();
            $array['info'] = false;
            throw $e;
        }

        return json_encode($array);
        
    }

    public function QueryBagianDua($dataArr){
        try {

            foreach($dataArr as $val){
                \DB::table('kuesioner_bagian_satu_repos')->insert([
                    [
                        'nomor_kuesioner' => $val['A'],
                        'nomor_bsn' => $val['B'],
                        'nama_surveyor' => $val['C'],
                        'tgl_survey' => date('Y-m-d',strtotime($val['D'])),
                        'propinsi' => $val['E'],

                        'ii_1' => $val['F'],
                        'ii_1_a' => $val['G'],
                        'ii_2' => $val['H'],
                        'ii_2_a' => $val['I'],
                        'ii_3' => $val['J'],
                        'ii_3_a' => $val['K'],
                        'ii_3_b' => $val['L'],
                        'ii_3_c' => $val['M'],
                        'ii_3_d' => $val['N'],
                        'ii_3_e' => $val['O'],
                        'ii_3_e_a' => $val['P'],
                        'ii_4' => $val['Q'],
                        'ii_5' => $val['R'],
                        'ii_6' => $val['S'],
                        'ii_6_a' => $val['T'],
                        'ii_7_a' => $val['U'],
                        'ii_7_b' => $val['V'],
                        'ii_7_c' => $val['W'],
                        'ii_7_d' => $val['X'],
                        'ii_7_d_a' => $val['Z'],
                        'ii_7_e_a' => $val['Z'],
                        
                        'ii_7_e_b' => $val['AA'],
                        'ii_8' => $val['AB'],
                        'ii_8_a' => $val['AC'],
                        'ii_8_b' => $val['AD'],
                        'ii_8_c' => $val['AE'],
                        'ii_9' => $val['AF'],
                        'ii_9_a' => $val['AG'],
                        
                    ],
                    
                ]);
            }

        
        } catch (Exception $e) {
            \DB::rollback();
            $array['info'] = false;
            throw $e;
        }
    }

    public function QueryBagianTiga($dataArr){
        $array = array('info'=>false);
        try{
            foreach($dataArr as $val){
                \DB::table('kuesioner_bagian_tiga')->insert([
                    [
                        'nomor_kuesioner' => $val['A'],
                        'nomor_bsn' => $val['B'],
                        'nama_surveyor' => $val['C'],
                        'tgl_survey' => date('Y-m-d',strtotime($val['D'])),
                        'propinsi' => $val['E'],

                        'iii_1' => $val['F'],
                        'iii_2_a' => $val['G'],
                        'iii_2_b' => $val['H'],
                        'iii_2_c' => $val['I'],
                        'iii_2_c_a' => $val['J'],
                        'iii_2_d' => $val['K'],
                        'iii_2_d_a' => $val['L'],
                        'iii_2_e' => $val['M'],
                        'iii_2_e_a' => $val['N'],
                        'iii_3' => $val['O'],
                        'iii_4' => $val['P'],
                        'iii_5_a' => $val['Q'],
                        'iii_5_b' => $val['R'],
                        'iii_5_c' => $val['S'],
                        'iii_5_c_a' => $val['T'],
                        'iii_5_d' => $val['U'],
                        'iii_5_d_a' => $val['V'],
                        'iii_6' => $val['W'],
                        'iii_7' => $val['X'],
                        'iii_8' => $val['Y'],
                        'iii_8_a' => $val['Z'],
                        'iii_8_b' => $val['AA'],
                        'iii_8_c' => $val['AB'],
                        'iii_8_d' => $val['AC'],
                        'iii_8_d_a' => $val['AD'],
                        'iii_9' => $val['AE'],
                        'iii_9_a' => $val['AF'],
                        'iii_10_a' => $val['AG'],
                        'iii_10_b' => $val['AH'],
                        'iii_10_c' => $val['AI'],
                        'iii_10_d' => $val['AJ'],
                        'iii_10_d_a' => $val['AK'],
                        'iii_11_a' => $val['AL'],
                        'iii_11_b' => $val['AM'],
                        'iii_11_c' => $val['AN'],
                        'iii_11_d' => $val['AO'],
                        'iii_11_e' => $val['AP'],
                        'iii_11_f' => $val['AQ'],
                        'iii_11_f_a' => $val['AR'],
                    ],
                    
                ]);
            }
            $array['info'] = true;
        }catch(Exception $e){
            \DB::rollback();
            $array['info'] = false;
            throw $e;
        }

        return json_encode($array);
        
    }

    public function QueryKuesioner($dataArr){
        $array = array('info'=>false);
        \DB::beginTransaction();
        try{
            foreach($dataArr as $val){
                \DB::table('kuesioner_umk')->insert([
                    [
                        'nama_input' => $val['A'],
                        'kode' => $val['B'], 
                        'nomor_kuesioner' => $val['C'],
                        'nomor_bsn' => $val['D'],
                        'nama_surveyor' => $val['E'],
                        'tgl_survey' => date('Y-m-d',strtotime($val['F'])),
                        'propinsi' => $val['G'],

                        'i_1' => $val['H'],
                        'i_2' => $val['I'],
                        'i_3' => $val['J'],
                        'i_4' => $val['K'],
                        'i_5' => $val['L'],
                        'i_6' => $val['M'],
                        'i_7' => $val['N'],
                        'i_8' => $val['O'],
                        'i_9' => $val['P'],
                        'i_10' => trim($val['Q']),
                        'i_10_a' => $val['R'],
                        'i_10_b' => $val['S'],

                        'i_11' => $val['Z'],
                        'i_11_a' => $val['AA'],
                        'i_12' => $val['AB'],
                        'i_12_a' => $val['AC'],
                        'i_13' => $val['AD'],
                        'i_13_a' => $val['AE'],
                        'i_14' => $val['AF'],
                        'i_15' => $val['AG'],
                        'i_16' => $val['AH'],
                        'jenis_umk' => $val['AI'],

                        'ii_1' => $val['AJ'],
                        'ii_1_a' => $val['AK'],
                        'ii_2' => $val['AL'],
                        'ii_2_a' => $val['AM'],
                        'ii_3' => $val['AN'],
                        'ii_3_a' => $val['AO'],
                        'ii_3_b' => $val['AP'],
                        'ii_3_c' => $val['AQ'],
                        'ii_3_d' => $val['AR'],
                        'ii_3_e' => $val['AS'],
                        'ii_3_e_a' => $val['AT'],
                        'ii_4' => $val['AU'],
                        'ii_5' => trim($val['AV']),
                        'ii_6' => $val['AW'],
                        'ii_6_a' => $val['AX'],
                        'ii_7_a' => $val['AY'],
                        'ii_7_b' => $val['AZ'],
                        'ii_7_c' => $val['BA'],
                        'ii_7_d' => $val['BB'],
                        'ii_7_d_a' => $val['BC'],
                        'ii_7_e_a' => $val['BD'],
                        'ii_7_e_b' => $val['BE'],
                        'ii_8' => $val['BF'],
                        'ii_8_a' => trim($val['BG']),
                        'ii_8_b' => $val['BH'],
                        'ii_8_c' => $val['BI'],
                        'ii_9' => $val['BJ'],
                        'ii_9_a' => $val['BK'],
                        'jumlah_umk_bersertifikat' => $val['BL'],

                        'iii_1' => $val['BM'],
                        'iii_2_a' => $val['BN'],
                        'iii_2_b' => $val['BO'],
                        'iii_2_c' => $val['BP'],
                        'iii_2_c_a' => $val['BQ'],
                        'iii_2_d' => $val['BR'],
                        'iii_2_d_a' => $val['BS'],
                        'iii_2_e' => $val['BT'],
                        'iii_2_e_a' => $val['BU'],
                        'iii_3' => $val['BV'],
                        'iii_4' => $val['BW'],
                        'iii_5_a' => $val['BX'],
                        'iii_5_b' => $val['BY'],
                        'iii_5_c' => $val['BZ'],
                        'iii_5_c_a' => $val['CA'],
                        'iii_5_d' => $val['CB'],
                        'iii_5_d_a' => $val['CC'],
                        'iii_6' => $val['CD'],
                        'iii_7' => $val['CE'],
                        'iii_8' => trim($val['CF']),
                        'iii_8_a' => $val['CG'],
                        'iii_8_b' => $val['CH'],
                        'iii_8_c' => $val['CI'],
                        'iii_8_d' => $val['CJ'],
                        'iii_8_d_a' => $val['CK'],
                        'iii_9' => $val['CL'],
                        'iii_9_a' => trim($val['CM']),
                        'iii_10_a' => $val['CN'],
                        'iii_10_b' => $val['CO'],
                        'iii_10_c' => $val['CP'],
                        'iii_10_d' => $val['CQ'],
                        'iii_10_d_a' => $val['CR'],
                        'iii_11_a' => $val['CS'],
                        'iii_11_b' => $val['CT'],
                        'iii_11_c' => $val['CU'],
                        'iii_11_d' => $val['CV'],
                        'iii_11_e' => $val['CW'],
                        'iii_11_f' => $val['CX'],
                        'iii_11_f_a' => $val['CY'],

                        'iv_1' => $val['CZ'],
                    ],
                    
                ]);
            }
            DB::commit();
            $array['info'] = true;
        }catch(Exception $e){
            \DB::rollback();
            $array['info'] = false;
            throw $e;
        }

        return json_encode($array);
        
    }

    public function postQueryBagianSatu(Request $request){
        $fupload = $request->file('file');
        $vdir_upload ='files';
        $fileName=str_random(20) . '.' . $fupload->getClientOriginalExtension();
        $destinationPath = public_path().'/'.$vdir_upload;
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777);
            //echo "The directory $destinationPath was successfully created.";
            //exit;
        } else {
            //echo "The directory $destinationPath exists.";
        }
        $fuploadName = $fupload->getClientOriginalName();
        $fupload->move($destinationPath, $fileName);
        $lokasi_file = $destinationPath.'/'.$fileName;
        $data = $this->getImportExcel2007($lokasi_file);
        if ($request->bagian == 'bagian_satu') {
            $this->QueryBagianSatu($data);
        }elseif ($request->bagian == 'bagian_dua') {
            $this->QueryBagianDua($data);
        }elseif ($request->bagian == 'bagian_tiga') {
            $this->QueryBagianTiga($data);
        }elseif ($request->bagian == 'bagian_empat') {
            $this->QueryBagianTiga($data);
        }elseif ($request->bagian == 'full') {
            $this->QueryKuesioner($data);
        }else{
            $this->QueryKuesioner($data);
        }
        
        \File::delete($lokasi_file);

        return redirect('/excel');
    }

    
}
