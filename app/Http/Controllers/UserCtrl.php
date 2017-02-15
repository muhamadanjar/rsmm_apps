<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use App\Lib\Pagging;
use App\Lib\AHelper;
class UserCtrl extends Controller
{
    public function __construct($value=''){
        $this->middleware('auth');
        $this->_page = new Pagging();
        $this->ahelper = new AHelper();
    }
    public function create()
    {
        $this->authorize('create.user');
    }

    public function create_dua(){
        if (auth()->user()->can('create.user')) {
            return view('users.create');
        }
 
        return abort(403);
    }

    public function getProfil($value=''){
        return view('master.profil');
    }

    public function getIndex(){
        if(isset($_GET["page"]))
        $page = (int)$_GET["page"];
        else
        $page = 1;

        $setLimit = 10;
        $pageLimit = ($page * $setLimit) - $setLimit;
        if(isset($_GET['txtsearch']))
        $data = $_GET['txtsearch'];
        else
        $data = '';

        $item = new User;
        $table_name = $item->getTable();
        
        $_page =  $this->_page->displayPaginationBelow($table_name,$setLimit,$page);

        $user = User::get();
        return view('master.userList')
            ->withPage($_page)
            ->withUsers($user);
    }

    
    public function getTambah(){
        $role = Role::get();
        $permission = Permission::get();
        return view('master.userAddEdit')
        ->withRole($role)
        ->withPermission($permission)
        ->withStatus('add');
    }

    public function postAddEdit(Request $request){
        \DB::beginTransaction();
        try {
            if ($request->isMethod('post')) {
                if($request->exists('image')){
                    $fileName = str_random(20) . '.' . $request->file('image')->getClientOriginalExtension();
                }
                $status = 0;
                $aksi = (session('aksi') == 'edit') ? 1 : 0;
                if ($aksi) {
                    $user = User::find($request->id);
                    if($request->exists('image')){
                        if(isset($user->image)){
                            $check_image = file_exists(public_path().'/images/users/'.$user->image);
                            if($check_image) unlink(public_path().'/images/users/'.$user->image);
                        }
                        
                        $this->ahelper->UploadImage($request->file('image'),'images/users',$fileName);
                        
                        $user->image = $fileName;
                    }
                }else{
                    $user = new User();
                    if($request->exists('image')){
                        $this->ahelper->UploadImage($request->file('image'),'images/users',$fileName);
                        $user->image = $fileName;
                    }
                }
                
                $user->username = $request->username;
                $user->name = $request->name;
                $user->email = $request->email;
                if($request->oldpassword == $request->password){
                    $user->password = $request->oldpassword;        
                }else{
                    $user->password = bcrypt($request->password);           
                }

                $user->save();
                if(!$user->hasRole($request->role)){$user->assignRole($request->role);}
                \DB::commit();
                $array['info'] = true;
                return redirect('pengaturan/user');
            }else{
                return redirect('pengaturan/user');
            }    
        } catch (Exception $e) {
            \DB::rollback();
            $array['info'] = false;
            throw $e;
        }
        
    }


    public function getUbah($id){
        $user = User::find($id);
        session(['aksi'=>'edit']);
        return view('master.userAddEdit')->withStatus('edit')->withUsers($user);
    }

    public function postHapus($id){
        $user = User::find($id);
        if (count($user) > 0) {
            $user->delete();
        }
        
        return redirect('pengaturan/user');
    }

    public function getAktif($id){
        $users = User::find($id);
        $users->isactive = ($users->isactive == 0) ? 1:0;
        $users->save();
        
        return redirect('pengaturan/user');
    }

    public function getLevel($layerid=''){
        $levelform = \Input::get('level');
        $array = array();
        $array2 = array();
        if(empty($layerid)){
            return 'layerid kosong';
        }
        foreach ($levelform as $key => $value) {
            $array['layer_id'] = $layerid;
            $array['role_id'] = $value;
            array_push($array2,$array); 
        }
        return $array2;
    }

    public function GetDftrLevel($lvl='') {
    
        $level = Role::whereRaw('id != ?',array(0))->get();
        $a = '';
        foreach ($level as $key => $value) {
            $ck = (strpos($lvl, ".$value->id") === false)? '' : 'checked';
            $a .= "<div class='row'><div class='col-md-12'>";
            $a .= "<label class='checkbox-primary'><input type=checkbox name='level[]' class='styled' value='$value->id' $ck> $value->id - $value->name</label>";
            $a .= "</div></div>";
        } 
        return $a;

    }
}
