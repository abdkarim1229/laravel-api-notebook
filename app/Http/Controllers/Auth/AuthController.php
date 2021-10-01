<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            return response([
                'status' => 200,
                'message' => "Login Success"
            ]);
        }
        return response([
            'status' => 402,
            'message' => "Login Failed"
        ]);
    }
}
