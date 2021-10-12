<?php

namespace App\Http\Controllers;

use App\Models\MessageFile;
use App\Models\RoomInitialState;
use App\Models\RoomInitialStateImage;
use App\Models\RoomInventory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    const INVENTORY = ['silla', 'escritorio', 'tabla_de_corcho', 'toallas', 'sábanas'];

    public function getUser($id): JsonResponse
    {
        $user = User::with('roomInitialState')
            ->with('roomInitialState.inventory')
            ->with('roomInitialState.images')
            ->where('id', $id)
            ->first();
        if (!$user) return response()->json(['message' => 'User not found'], 400);
        return response()->json($user);
    }

    public function setRoomInitialState(Request $request, $userId): JsonResponse
    {
        if (!$request->has('text')) {
            return response()->json(['message' => 'Bad request'], 400);
        }

        $files = $request->allFiles();
        if ($this->filesAreInvalid($files)) {
            return response()->json(['message' => 'file mime type not allowed'], 400);
        }

        $room = RoomInitialState::create([
            'user_id' => $userId,
            'text' => $request->input('text')
        ]);

        foreach (self::INVENTORY as $item) {
            RoomInventory::create([
                'room_initial_state_id' => $room->id,
                'name' => str_replace('_', ' ', $item),
                'checked' => $request->input($item)
            ]);
        }

        $this->saveFiles($files, $room->id, 'room/');

        return response()->json(RoomInitialState::with('inventory')->with('images')->find($room->id));
    }

    public function userInventory($userId): JsonResponse
    {
        return response()->json([
            'inventory' => [
                'silla', 'escritorio', 'tabla de corcho', 'toallas', 'sábanas'
            ]
        ]);
    }

    private function filesAreInvalid($files): bool
    {
        $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp'];

        foreach ($files as $filesEntry) {
            foreach ($filesEntry as $file) {
                if (!in_array($file->getMimeType(), $allowedMimeTypes)) return true;
            }
        }
        return false;
    }

    private function saveFiles($files, $id, $path): void
    {
        foreach ($files as $filesEntry) {
            for ($i = 0; $i < sizeof($filesEntry); $i++) {
                $file = $filesEntry[$i];
                $filename = $id . '_' . $i . '.' . $file->extension();
                Storage::putFileAs('public/'. $path, $file, $filename);
                RoomInitialStateImage::create([
                    'room_initial_state_id' => $id,
                    'url' => asset('storage/'. $path . $filename)
                ]);
            }
        }
    }
}
