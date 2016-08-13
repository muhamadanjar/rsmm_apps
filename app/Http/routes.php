<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::group(array('prefix'=>'rencanakerja'), function(){
	Route::get('','RKCtrl@index');
	Route::get('/mingguan','RKCtrl@mingguanindex');
	Route::get('/mingguan/add',['as' => 'mingguanadd', 'uses' => 'RKCtrl@mingguancreate']);
	Route::get('/mingguan/edit-{id}', ['as' => 'mingguanedit', 'uses' => 'RKCtrl@mingguanedit']);
	Route::get('/mingguan/delete-{id}', ['as' => 'mingguandelete', 'uses' => 'RKCtrl@mingguandelete']);
	Route::post('/mingguan/post', ['as' => 'mingguansaveedit', 'uses' => 'RKCtrl@mingguanstore']);
	
	Route::get('/harian','RKCtrl@harianindex');
	Route::get('/harian/edit-{id}', ['as' => 'harianedit', 'uses' => 'RKCtrl@harianedit']);
	Route::get('/harian/delete-{id}', ['as' => 'hariandelete', 'uses' => 'RKCtrl@hariandelete']);
	Route::post('/harian/post', ['as' => 'hariansaveedit', 'uses' => 'RKCtrl@harianstore']);
	
	Route::get('/analisis/harian','RKCtrl@analisisHarian');
	Route::post('/analisis/harian','RKCtrl@analisis_harian_view_post');
	
	Route::get('/analisis/mingguan','RKCtrl@analisisMingguan');
	Route::get('/analisis/bulanan','RKCtrl@analisisBulanan');
	
	Route::get('/nilai/harian','RKCtrl@nilaiHarian');
	Route::post('/nilai/harian','RKCtrl@nilaiHarian');
	
	Route::get('/nilai/mingguan','RKCtrl@nilaiMingguan');
	Route::post('/nilai/mingguan','RKCtrl@nilaiMingguan');

});
Route::post('/edit-bobot', ['as' => 'harianbobotedit', 'uses' => 'RKCtrl@harianeditajax']);
Route::group(array('prefix'=>'laporan'), function(){
	Route::get('index','ReportCtrl@ReportMaster');
	Route::post('rekapharian','ReportCtrl@postRekapHarian');
	
});


Route::get('user',	['as'=>'userlist','uses' => 'UserCtrl@index']);
Route::get('user/add',	['as'=>'useradd','uses' => 'UserCtrl@create']);
Route::get('user/edit-{id}', ['as' => 'useredit', 'uses'=>'UserCtrl@edit']);
Route::get('user/delete-{id}', ['as'=>'userdelete', 'uses'=>'UserCtrl@destroy']);
Route::post('user/post',	['as'=>'usersaveedit', 'uses'=>'UserCtrl@store']);
Route::get('user/aktif-{id}',	['as'=>'useraktifnon', 'uses'=>'UserCtrl@aktifnonaktif']);


Route::get('user/ubah','UserCtrl@getUbahUser');
Route::post('user/ubah','UserCtrl@getUbahUserPost');

//=============================================================//
Route::get('laporan','ReportCtrl@index');
Route::post('laporan/rekap','ReportCtrl@postRekap');

Route::get('laporan/harian-mingguan','ReportCtrl@indexHarianMingguan');
Route::post('laporan/rekap-hm','ReportCtrl@postRekapHM');

Route::get('laporan/rekap/xl-{namafile}','ReportCtrl@ReportExcel_rencanakerjaharian');



Route::group(array('prefix'=>'custom'), function(){
	
	
	Route::get('customnilai','RKCtrl@getNilai');
	Route::get('analisis','RKCtrl@getAnalisis');
	Route::get('minggu','RKCtrl@getMingguan');
	Route::get('harian','RKCtrl@getHarian');
	Route::get('analisismingguan','RKCtrl@getAnalisisMingguan');
	Route::get('analisisbulanan','RKCtrl@getAnalisisBulanan');
	Route::get('nilaimingguan','RKCtrl@getNilaiMingguan');
	Route::get('tgl','RKCtrl@getTglLoop');
	Route::get('analisis2','RKCtrl@getAnalisisHarian');
	
	Route::get('reportnilai','ReportCtrl@reportnilai');
	
	Route::get('jamtes',function(){
		$from       = '13:00:00';
		$to         = '18:00:00';
		
		$total      = strtotime($to) - strtotime($from);
		$hours      = floor($total / 60 / 60);
		$minutes    = round(($total - ($hours * 60 * 60)) / 60);
		
		echo $hours.'.'.$minutes;
	});
	
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



Route::get('cauth/login',  ['as' => 'login', 'uses' => 'CAuthCtrl@getLogin']);   
Route::post('cauth/login', ['as' => 'postlogin', 'uses'=>'CAuthCtrl@postLogin']);
Route::get('cauth/logout', ['as' => 'logout', 'uses' => 'CAuthCtrl@getLogout']);

Route::get('cauth/register', ['as' => 'registerUser', 'uses' => 'CAuthCtrl@getRegister']);
Route::post('cauth/register', ['as' => 'registerUserPost', 'uses' => 'CAuthCtrl@postRegister']);
