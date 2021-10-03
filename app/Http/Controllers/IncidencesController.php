<?php

namespace App\Http\Controllers;

use App\Models\Incidence;
use App\Models\IncidenceArea;
use App\Models\Residence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IncidencesController extends Controller
{
    public function getIncidences(Request $request)
    {
        if (!$request->has('userId')) return response()->json(['message' => 'User id must be specified'], 400);
        return response()->json(Incidence::with('messages')->where('user_id', $request->userId)->get());
    }

    public function getIncidence()
    {

    }

    public function createIncidence()
    {

    }

    public function getResidences(): JsonResponse
    {
        return response()->json(Residence::all());
    }

    public function getIncidenceAreas(): JsonResponse
    {
        return response()->json(IncidenceArea::all());
    }
}
