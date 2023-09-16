<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{

    public function carNumber()
    {
        return 'carNumber';
    }
    public function index(Request $request){
        return $request->user();
    }

    public function register(Request $request){
        $result=User::create([
           'carNumber'=>$request->carNumber,
            'Driver'=>$request->Driver,
            'Type'=>$request->Type,
            'password'=>Hash::make($request->password),


        ]);
        return $result;
    }

    public function login(Request $request){
        $credentials = [
            'carNumber' => $request['carNumber'],
            'password' => $request['password'],
        ];


        if(Auth::attempt($credentials)){
            $car=Auth::user();
            $activate=$car->activate;
            if($activate==1){
            $token=md5(time()).'.'.md5($request->carNumber);
            $name=$car->Driver;
            $car->forceFill([
               'api_token'=>$token,
            ])->save();
            return response()->json([
                'token'=>$token,
                'name'=>$name
            ]);
            }
            else{
                return response()->json([
                    'message'=>'the provided car is not activated'
                ],421);
            }

        }
        return response()->json([
            'message'=>'the provided car do not match our record'
        ],422);
    }
    public function logout(Request $request){
        $request->user()->forceFill([
            'api_token'=>null,
        ])->save();
        return response()->json(['message'=>'success']);
    }

}
