<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessageFile extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'chat_message_id',
        'url',
        'mime_type'
    ];
}
