<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;  //for password hidden

use Illuminate\Support\Facades\Auth; 

class UserController extends Controller
{

    public function login(Request $request){
        $request->validate([
            "email"=> "required",
            "password" => "required"
        ]);

        if( Auth::attempt([
            'email'=>$request->input('email'), 
            'password' =>$request->input('password')
        ])){
            $user = auth()-> user();
            $api = $user->createToken("Auth")-> accessToken;

            return response()-> json([
                "status"=> true, "message" => "User Login SuccessFully", "api"=> $api
            ]);
        }else{
            return response()-> json([
                "status"=> false, "message" => "Email or Password was wrong", "api"=> "",
            ]);
        }
    } 

    public function index(){
        $users = User::all();
        return $users;
    }

    public function redirect(){
        $info = array("message"=>"You Need to Authorized");
        return $info;
    }

    public function create(Request $request){
        //return $request->all();
        $user = User::create([
            "name"=>$request->input("name"),//mgmg
            "email"=>$request->input("email"),
            "password"=>Hash::make($request->input("password")) //for password hidden
        ]);

        $api = $user->createToken("Api Token")->accessToken;

        //$status = array("status"=>true, "message"=>"User Created Successfully", "api"=>$api);
        return response()-> json([
            "status"=> true,
            "message"=> "User Created Successfully",
            "api" => $api
        ]);
    }
}
