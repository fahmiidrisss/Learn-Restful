<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('nis', $request->nis)->first();

        if(!$user || !\Hash::check($request->password, $user->password))
        {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
            'message' => 'Authorized',
            'user' => $user,
            'token' => $token,
        ], 200);
    }
}
