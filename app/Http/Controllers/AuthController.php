<?php

namespace App\Http\Controllers;

use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
//use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function store(Request $request){
//        $auth = new JWTAuth('ghyiugbyu');
        $this->validate($request,[
           'name' => 'required',
           'email' => 'required|email',
           'password' => 'required|min:6'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' =>bcrypt($password)
        ]);

        $credentials=[
            'email' => $email,
            'password' => $password
        ];

        if($user->save()){

            $token = null;
            try{
                if (!$token = JWTAuth::attempt($credentials)){
                    return response()->json([
                        'msg' => 'Email password salah',
                    ], 400);
                }
            }catch (JWTAuthException $e){
                return response()->json([
                    'msg' => 'gagal memperoleh token',
                ], 400);
            }

            $user->signin = [
                'href' => 'api/v1/user/signin',
                'method' => 'POST',
                'params' => 'email,password'
            ];
            $response = [
                'msg' => 'User created',
                'user' => $user,
                'token' => $token
            ];
            return response()->json($response,201);
        }

    }
    public function signin(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');

        if ($user = User::where('email', $email)->first()){
            $credentials=[
            'email' => $email,
            'password' => $password
        ];

            $token = null;
            try{
                if (!$token = JWTAuth::attempt($credentials)){
                    return response()->json([
                        'msg' => 'Email password salah',
                    ], 400);
                }
            }catch (JWTAuthException $e){
                return response()->json([
                    'msg' => 'gagal memperoleh token',
                ], 400);
            }

            $response = [
                'msg' => 'User created',
                'user' => $user,
                'token' => $token
            ];
            return response()->json($response,201);
        }

    }
//    }
}
