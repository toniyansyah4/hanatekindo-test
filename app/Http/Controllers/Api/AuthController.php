<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = auth()->user();

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        try {
            if (Auth::check()) {
                $tokens = $request->user()->tokens;
                foreach ($tokens as $token) {
                    $token->delete();
                }

                $response = 'You have been succesfully logged out!';
                return response()->json([
                    'message' => $response
                ]);
            }

            $response = 'Logout failed, please check again!';
            return response()->json([
                'message' => $response
            ]);
        } catch (\Throwable $th) {

            $response = 'Logout failed, please check again!';
            return response()->json([
                'message' => $response
            ]);
        }
    }
}
