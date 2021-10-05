<?php

namespace App\Http\Controllers;

use App\Models\Incidence;
use App\Models\IncidenceArea;
use App\Models\IncidenceFile;
use App\Models\Residence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IncidencesController extends Controller
{
    public function getIncidences(Request $request): JsonResponse
    {
        if (!$request->has('userId')) return response()->json(['message' => 'User id must be specified'], 400);
        return response()->json(Incidence::with('messages')->where('user_id', $request->userId)->get());
    }

    public function getIncidence($id): JsonResponse
    {
        $incidence = Incidence::with('messages')->where('id', $id)->first();
        if (!$incidence) return response()->json(['message' => 'Incidence not found'], 404);
        return response()->json($incidence);
    }

    public function createIncidence(Request $request): JsonResponse
    {
        if (!$request->has('residence') || !$request->has('area') ||
            !$request->has('subject') || !$request->has('message') ||
            !$request->has('userId')) {
            return response()->json(['message' => 'Bad request'], 400);
        }

        $files = $request->allFiles();
        if ($this->filesAreInvalid($files)) {
            return response()->json(['message' => 'file mime type not allowed'], 400);
        }

        $incidence = Incidence::create([
            'residence_id' => $request->input('residence'),
            'incidence_area_id' => $request->input('area'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'user_id' => $request->input('userId')
        ]);

        foreach ($files as $filesEntry) {
            for ($i = 0; $i < sizeof($filesEntry); $i++) {
                $file = $filesEntry[$i];
                $filename = 1 . '_' . $i . '.' . $file->extension();
                Storage::putFileAs('public/incidences', $file, $filename);
                IncidenceFile::create([
                    'incidence_id' => $incidence->id,
                    'url' => asset('storage/incidences/' . $filename),
                    'mime_type' => $file->getMimeType()
                ]);
            }
        }

        return response()->json(Incidence::with('images')->where('id', $incidence->id)->first());
    }

    public function getResidences(): JsonResponse
    {
        return response()->json(Residence::all());
    }

    public function getIncidenceAreas(): JsonResponse
    {
        return response()->json(IncidenceArea::all());
    }

    private function filesAreInvalid($files): bool
    {
        $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp'];

        foreach ($files as $filesEntry) {
            foreach ($filesEntry as $file) {
                if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
                    return true;
                }
            }
        }
        return false;
    }
}
