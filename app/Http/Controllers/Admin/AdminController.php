<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Search;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\clients;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class AdminController extends Controller {
    
    public function __construct(){
        
        $user = \Auth::user();
        var_dum($user); die;
        if($user->user_roles == "superadmin"){
            return redirect('/admin/dashboard');
        } else {

           return view('home'); 
        }
    }

    public function dashboard(Request $request){

        $users = User::where('user_roles','!=','superadmin')->orderBy("id",'DESC')->get();
        
    	return view('admin.dashboard')->with('users',$users);
    }

    public function addNewUser(Request $request){

        return view('admin.add-user');
    }

    public function addUser(Request $req ){

        $this->validate($req,[
                //'name' => 'required',
                'username' => 'required',
                'password' => 'required'
            ],[
                //'name.required' => 'The name field is required.',
                'username.required' => 'The username field is required.',
                'password.required' => 'The password field is required.',
            ]);
        $checkUsername = User::where("username",'=',$req->post('username'))->count();
        if($checkUsername){
           $notification = array(
            'message' => "Username already taken. Try with another", 
            'alert-type' => 'error'
        );
        return \Redirect::to('admin/add')->with($notification);
        } 
        $data = array(
                    "user_roles"=>'guest',
                    "username"=>$req->input('username'),
                    "name"=>$req->input('name'),
                    "password"=>\Hash::make($req->input('password')),
                    "remember_token"=>$req->input('_token'),
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now()
                );

        \DB::table('users')->insert($data); 
        
        $notification = array(
            'message' => "User Created successfully.", 
            'alert-type' => 'success'
        );
        return \Redirect::to('admin/dashboard')->with($notification);
    }

    public function deleteUser($id){

        $user = User::find($id);    
        $result = $user->forceDelete();
        if($result){
            $notification = array(
                'message' => "User delete successfully.", 
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => "User not exist with our database.", 
                'alert-type' => 'error'
            );
        
        }
        return \Redirect::to('admin/dashboard')->with($notification);
    }

    public function editUser($id){

        $user = User::find($id);
        return view('admin.user-edit')->with('AdminData',$user);
    }


    public function updateUserDetails(Request $request){

        $checkUsername = User::where("username",'=',$request->post('username'))
                                ->where("id","!=",$request->post('user_id'))->count();

        if($checkUsername){
           $notification = array(
                'message' => "Username already taken. Try with another", 
                'alert-type' => 'error'
            );
           return \Redirect::to('admin/dashboard')->with($notification);
       } else {

            $user = User::find($request->post('user_id'));
            
            if(!empty($request->post('username'))){
                $user->username = $request->post('username');
            }

            if(!empty($request->post('name'))){
                 $user->name = $request->post('name');
            }

            if(!empty($request->post('password'))){
                $user->password = \Hash::make($request->post('password'));    
            }
           
            $user->updated_at = \Carbon\Carbon::now();
            $user->save();
            $notification = array(
                'message' => "User updated successfully.", 
                'alert-type' => 'success'
            );
            return \Redirect::to('admin/dashboard')->with($notification);
       }
        
    }

    public function getRecords(Request $request){

        $users = Search::orderBy("name","ASC")->paginate(15);
        return view('admin.records')->with('users',$users);
    }
    
}