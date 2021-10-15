<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'sender',
        'chat_id'
    ];

    public function files()
    {
        return $this->hasMany(ChatMessageFile::class);
    }
}
