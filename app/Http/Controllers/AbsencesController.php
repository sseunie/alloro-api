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

    public function createAbsence(Request $request): JsonResponse
    {
        if (!$request->has('observations') || !$request->has('userId') ||
            !$request->has('startDate') || !$request->has('finishDate')) {
            return response()->json(['message' => 'Bad request'], 400);
        }

        if(!$request->has('observations')) {
            $absence = Absence::create([
                'start_date' => $request->input('startDate'),
                'finish_date' => $request->input('finishDate'),
                'user_id' => $request->input('userId')
            ]);
            return response()->json($absence);
        }

        $absence = Absence::create([
            'observations' => $request->input('observations'),
            'start_date' => $request->input('startDate'),
            'finish_date' => $request->input('finishDate'),
            'user_id' => $request->input('userId')
        ]);

        return response()->json($absence);
    }
}
