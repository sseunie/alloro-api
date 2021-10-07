<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageFile extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'message_id',
        'url',
        'mime_type'
    ];
}
