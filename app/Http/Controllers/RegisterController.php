<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        $accessToken = $user->createToken("auth-token")->plainTextToken;

        return \response()->json([
            "status" => "success",
            "message" => "Successfully registered",
            "data" => [
                "access_token" => $accessToken,
                "id" => $user->id,
                "name" => $request->name,
                "email" => $request->email,
            ]
        ]);

    }
}
