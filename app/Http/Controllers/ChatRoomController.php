<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRoomRequest;
use App\Http\Requests\UpdateChatRoomRequest;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRoomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ChatRoom $chatRoom)
    {
        $users = User::all();

        return view('home', compact('users', 'chatRoom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChatRoom $chatRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRoomRequest $request, ChatRoom $chatRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatRoom $chatRoom)
    {
        //
    }

    public function createOrGet(User $user)
    {
        $users = User::all();

        $authUserChatRoomIds = auth()->user()->rooms()->pluck('chat_room_id')->all();
        $commonRoom = $user->rooms()->whereIn('chat_room_id', $authUserChatRoomIds)->first();

        if(!$commonRoom){
            $chatRoom = ChatRoom::create();

            $chatRoom->users()->attach([auth()->user(), $user]);
        }
        else{
            $chatRoom = $commonRoom;
        }
        
        return view('home', compact('users', 'chatRoom'));
    }
}
