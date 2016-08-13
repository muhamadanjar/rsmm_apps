<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lib\AHelper;
use Illuminate\Http\Request;

class UserCtrl extends Controller {


	public function __construct(){
		$this->middleware('auth.admin',[ 'except'=> ['getUbahUser']]);
		$this->_s = new AHelper();
	}
	public function index(){
		$users = \App\User::where('username','!=','admin')->get();
		return view('master.userlist')->with('users',$users);
	}

	
	public function create(){
		$kode = $this->_s->otomatis_kode('USR','users','nik');
		$status = 'add';
		return view('master.userAddEdit')->with('status',$status)->with('kode',$kode);
	}

	public function store(Request $request){
		$destinationPath = public_path('images');
		$filePhoto = $request->file('photo');
			
		$qlayer = ($request->id == null) ? new \App\User : \App\User::find($request->id);
		$users = $qlayer;
		$users->username = $request->username;
		$users->name = $request->name;
		$users->email = $request->email;
		$users->isactive = 1;
		$users->alamat = $request->alamat;
        $users->ttl = $request->ttl;
		$users->divisi_id = 0;
		if(!empty($filePhoto)){
			$fileName = str_random(20) . '.' . $filePhoto->getClientOriginalExtension();
			$users->photo = $fileName;
			$this->_s->UploadImage($filePhoto);
		}
		
		if ($request->status == 'edit') {
			if($request->oldpassword == $request->password){
				$users->password = $request->oldpassword;
			}else{
				$users->password = bcrypt($request->password);	
			}
			if (!$users->hasRole('admin')) {
				if(!$users->hasRole('biasa')){
					$users->assignRole(2);
				}
			}
			
		}else{
			$users->password = bcrypt($request->password);
		}
		$users->save();
		return redirect('user');
	}


	public function edit($id){
		$status = 'edit';
		$users = \App\User::find($id);
		$kode = $this->_s->otomatis_kode('USR','users','nik');
		return view('master.userAddEdit')->with('users',$users)->with('status',$status);
	}

	
	public function destroy($id){
		$users = \App\User::find($id);
		$users->revokeRole(2);
		$users->delete();

		return redirect('user');
	}
	public function aktifnonaktif($id){
		$users = \App\User::find($id);
		$users->isactive = ($users->isactive == 0) ? 1:0;
		$users->save();
		
		return redirect('user');
	}


	public function getUbahUser(){
		$users = \Auth::user();
		return view('auth.UbahUser')->with('users',$users);	
	}

	public function getUbahUserPost(Request $request){

		$qlayer = \App\User::find(\Auth::user()->id);
		$users = $qlayer;
		
		$users->name = $request->name;
		$users->email = $request->email;
		$users->isactive = 1;
		$users->username = $request->username;
		
			if($request->oldpassword == $request->password){
				$users->password = $request->oldpassword;
			}else{
				$users->password = bcrypt($request->password);	
			}
		$users->save();
		return redirect('/');
	}

}
