<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // login as guest
    public function __construct()
    {
        $this->middleware('guest');
    }
    // login
    public function __invoke(Request $request)
    {
        $credentials = $request->only('email', 'username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token-name')->plainTextToken;

            return (new UserResource($user))->additional(compact('token'));
        }

        return response()->json([
            'message' => 'Email/Username or Password mismatch',
        ], Response::HTTP_UNAUTHORIZED);
    }
}
