<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    // change password
    public function __invoke(ChangePasswordRequest $request)
    {
        $password = $request->get('password');
        $user = $request->user();

        if (Hash::check($password, $user->password)) {
            $user->password = bcrypt($password);
            $user->save();
        }

        // Auto logout user
        $user->currentAccessToken()->delete();

        return response()->noContent();
    }
}
