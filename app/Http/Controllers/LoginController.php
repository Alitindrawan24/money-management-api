<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if(Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            /** @var $user */
            $user = auth()->user();
            $user->tokens()->delete();
            $accessToken = $user->createToken("auth-token")->plainTextToken;

            return \response()->json([
                "status" => "success",
                "message" => "Successfully login",
                "data" => [
                    "access_token" => $accessToken,
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                ]
            ]);
        } else {
            return \response()->json([
                "status" => "fail",
                "message" => "Invalid credentials"
            ], 400);
        }
    }
}
