<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'incidence_id',
        'text',
        'sender'
    ];

    public function files()
    {
        return $this->hasMany(MessageFile::class);
    }
}
