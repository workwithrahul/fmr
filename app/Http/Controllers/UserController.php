<?php

namespace App\Http\Controllers;

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

class UserController extends Controller {
    
    public function checkUserName(Request $request){

    	$user = User::where("username",'=',$request->post('username'))->count();
    	if($user){
    		return response()->json(['status'=>false,'msg'=>"That Universal Tail Number is taken. Try another."]);
    	} else {
    		return response()->json(['status'=>true,'msg'=>"Universal Tail Number available"]);
    	}
    	
    }

    public function createUser(Request $request){

    	$user = User::where("email",'=',$request->post('email'))->count();

        $checkUsername = User::where("username",'=',$request->post('username'))->count();
        if($checkUsername){
            return response()->json(['status'=>false,'msg'=>"That Universal Tail Number is taken. Try another."]);
        }        
        if (!filter_var($request->post('email'), FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status'=>false,'msg'=>"Invalid email."]);
        }
    	if($user){
    		return response()->json(['status'=>false,'msg'=>"E-mail address already in use."]);
    	} else {
    		// Create new record
    		$otp = mt_rand(100000,999999);
    		$user = new User;
    		$user->username = $request->post('username');
    		$user->email = $request->post('email');
    		$user->password = \Hash::make($request->post('password'));
    		$user->otp = $otp;
    		$user->otp_verified = "0";
    		$user->remember_token = $request->post('_token');
            $user->created_at =  \Carbon\Carbon::now();
            $user->updated_at = \Carbon\Carbon::now();
            //Send OTP via email
            $userEmail = $request->post('email');
            $userData = array("otp"=>$otp);
            $res = \Mail::send('emails.verify-otb', $userData, function ($message) use($otp, $userEmail) {
                $message->from("no-reply@nextfbo.com");
                $message->to($userEmail)->subject("Your verification code");
                $message->setBody($otp, 'text/html');
            });
            $user->save(); // Save user data
            auth()->login($user); 
            return response()->json(['status'=>true,'msg'=>"user created successfully."]);
    	}
    }

    public function homeView(){
        $user = \Auth::user();
        if($user->user_roles == "superadmin"){
            return redirect('/admin/dashboard');
        } else {

           return view('home'); 
        }

    	
    }

    public function login(Request $request) {

        if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
                $user = \Auth::user();
                auth()->login($user); 
                return response()->json(['status'=>true,'message'=>'you have been logged in succesfully','data' => $user]);
        } else {
            return response()->json(['status'=>false,'message' => 'Your username or password was incorrect.']);
        }
    }

    public function verifyOtpView(Request $request){
        $user = \Auth::user();
        if(\Auth::check()){
            return view('verify-otp');
        } else {
            return redirect('/login');
        }
        return view('verify-otp');
    }

    public function verifyOtp(Request $request){

        $user = User::where("id",'=',$request->post('user_id'))
                    ->where("otp",'=',$request->post('otp'))        
                    ->count();
        if($user){
            $user = User::find($request->post('user_id'));
            $user->otp_verified = "1";
            $user->save();
            return response()->json(['status'=>true,'message'=>"Verification otp succesfully."]);
        } else {
            return response()->json(['status'=>false,'message'=>"Invalid verification code."]);
        }
    }

    public function resendOtp(Request $request){

       $user = User::where("id",'=',$request->post('user_id'))->count();
        if($user){
            $user = User::find($request->post('user_id'));
            $otp = mt_rand(100000,999999);
            $user->otp_verified = "0";
            $user->otp = $otp;
            $user->updated_at = \Carbon\Carbon::now();
            $user->save();
             $dataEmail = array("otp"=>$otp);
            \Mail::send('emails.verify-otb', $dataEmail, function ($message) use($otp, $user) {
                $message->from("no-reply@nextfbo.com");
                $message->to($user->email)->subject("Your verification code");
                $message->setBody($otp, 'text/html');
            });
            return response()->json(['status'=>true,'message'=>"Verification code sent succesfully. Please check your email"]);
        } else {
            return response()->json(['status'=>false,'message'=>"This user not exist with our database"]);
        }
    }

    public function forgotPasswordView(Request $request){
        return view('forgot-password');
    }

    public function forgotPassword(Request $request){

        $input['email'] = Input::get('email');

        $rules = array('email' => 'unique:users,email');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            // Send email
            $user = User::where('email', request()->input('email'))->first();
            $token = Password::getRepository()->create($user);
            $user->sendPasswordResetNotification($token);
            return response()->json(['status'=>true,'message' => 'We have e-mailed your password reset link!']);
        } else {
            return response()->json(['status'=>false,'message' => 'This email not exsit with us. Please try with correct one']);
        }
    }

    public function searchName(Request $request){

        $users = Search::where('name', 'like','%'.$request->post('q').'%')->get();
        $array['items'] = $users->toArray();
         echo json_encode($array);
        die;
    }
}