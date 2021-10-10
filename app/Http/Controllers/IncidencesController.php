<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Incidence;
use App\Models\IncidenceArea;
use App\Models\IncidenceFile;
use App\Models\Message;
use App\Models\MessageFile;
use App\Models\Residence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IncidencesController extends Controller
{
    public function getIncidences(Request $request): JsonResponse
    {
        if (!$request->has('userId')) return response()->json(['message' => 'User id must be specified'], 400);
        return response()->json(Incidence::with('messages')
            ->with('messages.files')
            ->with('files')
            ->with('residence')
            ->with('incidence_area')
            ->where('user_id', $request->userId)->get());
    }

    public function getIncidence($id): JsonResponse
    {
        $incidence = Incidence::with('messages')
            ->with('messages.files')
            ->with('files')
            ->with('residence')
            ->with('incidence_area')
            ->where('id', $id)->first();
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

        $this->saveFiles($files, $incidence, 'incidences/');

        return response()->json(Incidence::with('files')
            ->with('messages')
            ->with('residence')
            ->with('incidence_area')
            ->where('id', $incidence->id)->first());
    }

    public function createMessage(Request $request, $id): JsonResponse
    {
        if (!$request->has('text') || !$request->has('userId')) {
            return response()->json(['message' => 'Bad request'], 400);
        }

        $files = $request->allFiles();
        if ($this->filesAreInvalid($files)) {
            return response()->json(['message' => 'file mime type not allowed'], 400);
        }

        $message = Message::create([
            'incidence_id' => $id,
            'sender' => $request->input('userId') != 0 ? 'client' : 'residence',
            'text' => $request->input('text')
        ]);

        $this->saveFiles($files, $message, 'incidences/messages/');

        if ($message->sender == 'residence') {
            $incidence = Incidence::find($message->incidence_id);
            $incidence->read = false;
            $incidence->save();
            broadcast(new NewMessage($message->incidence_id))->toOthers();
        }

        return response()->json(Message::with('files')
            ->where('id', $message->id)->first());
    }

    public function updateReadStatus($id): JsonResponse
    {
        $incidence = Incidence::find($id);
        $incidence->read = true;
        $incidence->save();

        return response()->json($incidence);
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
                if (!in_array($file->getMimeType(), $allowedMimeTypes) &&
                    !str_contains($file->getMimeType(), 'audio/')) {
                    return true;
                }
            }
        }
        return false;
    }

    private function saveFiles($files, $model, $path): void
    {
        foreach ($files as $filesEntry) {
            for ($i = 0; $i < sizeof($filesEntry); $i++) {
                $file = $filesEntry[$i];
                $filename = $model->id . '_' . $i . '.' . $file->extension();
                Storage::putFileAs('public/'. $path, $file, $filename);
                MessageFile::create([
                    'message_id' => $model->id,
                    'url' => asset('storage/'. $path . $filename),
                    'mime_type' => $file->getMimeType()
                ]);
            }
        }
    }
}
