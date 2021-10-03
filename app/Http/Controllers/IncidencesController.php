<?php

namespace App\Http\Controllers;

use App\Models\IncidenceArea;
use App\Models\Residence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IncidencesController extends Controller
{
    public function getIncidences()
    {

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
