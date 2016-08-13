<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

use App\Lib\AHelper;
use Session;
use App\User;

class CAuthCtrl extends Controller {

    protected $redirectTo = 'dashboard';
    protected $redirectPathEditor = 'map';

    public function __construct(Guard $auth){
        $this->auth = $auth;
        
        $this->_s = new AHelper();
        //$this->_s = new AHelper();
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin() {

        return view('cauth.login'); //or just use the default login page
    }

    public function postLogin(Request $request) {
     

        $this->validate($request, [
            'username' => 'required', 
            'password' => 'required',
        ]);
        $credentials = $request->only('username', 'password');
        //$auth_by = (str_contains($request->login, '@')) ? 'email' : 'username';
        
		$usercek = \App\User::where('username','=',$request->username)->first(); 
		if($usercek->isactive == 1){
			if (Auth::attempt($credentials,$request->has('remember'))){   
				$user = User::find(Auth::user()->id);
				$user->latestlogin = date('Y-m-d H:i:s');
				$user->save();
				//$this->_s->updateSessionMenu();
			   
				return redirect()->intended($this->redirectPath());
			}
		}
        

        return redirect($this->loginPath())
                    ->withInput($request->only('username', 'remember'))
                    ->withErrors([
                        'username' => $this->getFailedLoginMessage(),
                    ]);
    }

    

    public function getLogout(){
        $this->auth->logout();
       
     
        //Session::forget('menusess');
        //Session::forget('menusessnav');
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    protected function getFailedLoginMessage(){
        return 'Username dan password yang anda masukan salah.';
    }

    public function redirectPath(){
        if (property_exists($this, 'redirectPath')){
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    
    public function loginPath(){
        return property_exists($this, 'loginPath') ? $this->loginPath : '/cauth/login';
    }


    public function getRegister() {
		$kode = $this->_s->otomatis_kode('USR','users','nik');
        return view('auth.registerUser')->with('kode',$kode); //or just use the default login page
    }

    public function PostRegister(Request $request) {
        if($request->password_confirmation == $request->password){

            $destinationPath = public_path('images');
			$filePhoto = $request->file('photo');
            
            
            $users =  new \App\User;
            $users->username = $request->username;
            $users->name = $request->name;
            $users->email = $request->email;
            $users->isactive = 0;
            $users->nik = $request->nik;
            $users->alamat = $request->alamat;
            $users->ttl = $request->ttl;
            $users->password = bcrypt($request->password);
            
            if(!empty($filePhoto)){
				$fileName = str_random(20) . '.' . $filePhoto->getClientOriginalExtension();
				$users->photo = $fileName;
				$folderupload = public_path('images').'/users/';
				$this->_s->UploadImage($filePhoto,$folderupload);
			}

            $users->divisi_id = 0;
            $users->save();
            
			
			
            return redirect()->intended($this->redirectPath());
        }else{
            return redirect($this->loginPath())
                    ->withErrors([
                        'password' => 'Harus sama dengan password konfirmasi',
                    ]);
        }
        
    }

    
}
