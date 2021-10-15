<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\ChatMessageFile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChatsController extends Controller
{
    public function getChat($id): JsonResponse
    {
        $chat = Chat::with('messages')
            ->with('messages.files')
            ->where('user_id', $id)
            ->first();
        return response()->json($chat);
    }

    public function createMessage(Request $request, $id): JsonResponse
    {
        if (!$request->has('text')) {
            return response()->json(['message' => 'Bad request'], 400);
        }

        $files = $request->allFiles();
        if ($this->filesAreInvalid($files)) {
            return response()->json(['message' => 'file mime type not allowed'], 400);
        }

        $message = ChatMessage::create([
            'chat_id' => $id,
            'sender' => $request->input('userId') != 0 ? 'client' : 'residence',
            'text' => $request->input('text')
        ]);

        $this->saveMessageFiles($files, $message);

        if ($message->sender == 'residence') {
            $chat = Chat::find($id);
            $chat->read = false;
            $chat->save();
            broadcast(new NewChatMessage($chat))->toOthers();
        }

        return response()->json(ChatMessage::with('files')->find($message->id));
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

    private function saveMessageFiles($files, $model): void
    {
        foreach ($files as $filesEntry) {
            for ($i = 0; $i < sizeof($filesEntry); $i++) {
                $file = $filesEntry[$i];
                $filename = $model->id . '_' . $i . '.' . $file->extension();
                Storage::putFileAs('public/'. 'chat/messages/', $file, $filename);
                ChatMessageFile::create([
                    'chat_message_id' => $model->id,
                    'url' => asset('storage/'. 'chat/messages/' . $filename),
                    'mime_type' => $file->getMimeType()
                ]);
            }
        }
    }
}
