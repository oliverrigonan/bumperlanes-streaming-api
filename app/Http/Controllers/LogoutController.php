<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    // logout
    public function __invoke(Request $request)
    {
        // Revoke the user's current token...
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
