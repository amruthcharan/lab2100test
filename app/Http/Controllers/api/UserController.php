<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

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
}
