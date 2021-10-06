<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!$request->has('email') && !$request->has('password')) {
            return response()->json(['message' => 'Credentials missing'], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Login invalid'], 503);
        }

        return response()->json([
            'id' => $user->id,
            'token' => $user->createToken('spa')->plainTextToken
        ]);
    }
}
