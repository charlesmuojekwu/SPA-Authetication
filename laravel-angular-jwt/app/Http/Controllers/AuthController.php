<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

    }

    public function login(Request $request) 
    {
        if(!Auth::attempt($request->only('email','password')))
        {
            return response([
                'message' => 'Invalid Login Credentials'
            ],Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60*24);

        return response([
            'message' => 'Logged successfully'
        ])->withCookie($cookie);

    }


    public function user() 
    {
        return response([
            'User' => Auth::user(),
            //'Token' => Auth::user()->createToken('token')->plainTextToken
        ]);
    }

    public function book() 
    {
        return 'this is the book';
    }


    public function logout() 
    {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}
