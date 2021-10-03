<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    public function getUser($id): JsonResponse
    {
        $user = User::where('id', $id)->first();
        if (!$user) return response()->json(['message' => 'User not found'], 400);
        return response()->json($user);
    }
}
