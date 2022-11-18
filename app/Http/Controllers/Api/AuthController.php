<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Exception;
use Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendEmail;
class AuthController extends Controller
{
    public $successStatus = 200;
    /** 
        * login api 
        * 
        * @return \Illuminate\Http\Response 
        */ 
       public function login(){ 
           if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
               $user = Auth::user(); 
               $success['message'] = "User Logged Succesfully";
               $success['status'] = 'success';
               $userdata['user_id'] = $user->id;
               $userdata['name'] = $user->name;
               $userdata['email'] = $user->email;
               $userdata['token'] =  $user->createToken('MyLaravelApp')->accessToken; 
               $success['data'] =  $userdata;
               return response()->json($success, $this->successStatus); 
           } 
           else{ 
               return response()->json(['error'=>'Enter Email and password'], 400); 
           } 
       }
    
    /** 
        * Register api 
        * 
        * @return \Illuminate\Http\Response 
        */ 
       public function register(Request $request) 
       { 
           $validator = Validator::make($request->all(), [ 
               'name' => 'required',
               'email' => 'required|email|unique:users',
               'password' => 'required',
            //    'c_password' => 'required|same:password',
           ]);
           if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 400);            
            }
            $input = $request->all(); 
            $input['password'] = bcrypt($input['password']); 
            $otp = rand(1000, 9999);
            $user = User::create($input); 
            $success['message'] = "User Register Succesfully";
            $success['status'] = 'succsess';
            $userData['userId'] = $user->id;
            $userData['name'] =  $user->name;
            $userData['email'] = $user->email;
            $userData['password'] = $user->password;
            Log::info("otp = ".$otp);
            $userd = User::where('email','=',$request->email)->update(['otp' => $otp]);
            $userData['token'] =  $user->createToken('MyLaravelApp')->accessToken; 
           $success['data'] = $userData;
           return response()->json($success, $this->successStatus); 
       }

        public function verifyOtp(Request $request){
        
            $user  = User::where([['email','=',$request->email],['otp','=',$request->otp]])->first();
            if($user){
                auth()->login($user, true);
                User::where('email','=',$request->email)->update(['otp' => null]);
                $accessToken = auth()->user()->createToken('authToken')->accessToken;

                return response(["status" => 200, "message" => "Success", 'user' => auth()->user(), 'access_token' => $accessToken]);
            }
            else{
                return response(["status" => 401, 'message' => 'Invalid']);
            }
        }
    
        /** 
        * details api 
        * 
        * @return \Illuminate\Http\Response 
        */ 
       public function userinfo() 
       { 
           $user = Auth::user(); 
           return response()->json(['success' => $user], $this->successStatus); 
       }


}
