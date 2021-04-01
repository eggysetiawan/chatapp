<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'user_id'];

    // bad practice

    // public function room()
    // {
    //     return $this->hasOne(ChatRoom::class, 'id', 'chat_room_id');
    // }
    // public function user()
    // {
    //     return $this->hasOne(User::class, 'id', 'user_id');
    // }

    // best practice
    public function room()
    {
        return $this->belongsTo(ChatRoom::class, 'chat_room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
