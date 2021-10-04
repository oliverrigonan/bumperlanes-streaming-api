<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    // display list
    public function index(): AnonymousResourceCollection
    {
        $users = User::all();

        return UserResource::collection($users);
    }
    // detail by email
    public function user_by_email(Request $request): AnonymousResourceCollection {
        $email = $request->email;
        $users = User::where('email', $email)->get();

        return UserResource::collection($users);
    }
    // detail by username
    public function user_by_username(Request $request): AnonymousResourceCollection {
        $username = $request->username;
        $users = User::where('username', $username)->get();

        return UserResource::collection($users);
    }
    // edit
    public function update(UserRequest $request, $id): UserResource
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->user_type = $request->user_type;
        $user->save();

        return new UserResource($user->refresh());
    }
}
