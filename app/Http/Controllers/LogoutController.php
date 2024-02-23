<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        /** @var $user */
        $user = auth()->user();
        $user->tokens()->delete();

        return \response()->json([
            "status" => "success",
            "message" => "Logged out successfully"
        ]);
    }
}
