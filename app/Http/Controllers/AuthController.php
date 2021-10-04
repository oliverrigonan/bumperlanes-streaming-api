<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // dislay list
    public function index(Request $request)
    {
        return new UserResource($request->user());
    }
    // edit
    public function update(Request $request)
    {
        $data = $request->only('name', 'email');
        $request->user()->update($data);

        return new UserResource($request->user());
    }
}
