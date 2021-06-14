<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt(['email' => $request->post('email'), 'password' =>$request->post('password')])) {
            return response()->json([
                'message' => 'invalid data',
                'errors' => [
                    'email' => [
                        'invalid credentials'
                    ]
                ]
            ]);
        }

        return response()->json([
            'token' => auth()->user()->createToken('auth-token')->plainTextToken,
            'status' => true,
            'message' => 'Login Successful'
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => true,
            'message' => 'Logout Successful'
        ]);
    }
}
