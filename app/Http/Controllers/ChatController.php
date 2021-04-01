<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function rooms()
    {
        return ChatRoom::all();
    }

    public function messages(ChatRoom $chatRoom)
    {
        return $chatRoom->messages()
            ->with('user')
            ->latest()
            ->get();
    }

    public function newMessage(ChatRoom $chatRoom)
    {
        return $chatRoom->messages()->create([
            'message' => request('message'),
            'user_id' => auth()->id(),
        ]);
    }
}
