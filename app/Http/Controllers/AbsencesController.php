<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AbsencesController extends Controller
{
    public function getAbsences(Request $request): JsonResponse
    {
        if (!$request->has('userId')) return response()->json(['message' => 'User id must be specified'], 400);
        return response()->json(Absence::where('user_id', $request->userId)->get());
    }

    public function createAbsence()
    {

    }
}
