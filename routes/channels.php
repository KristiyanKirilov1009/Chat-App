<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('chat.{chatRoomId}', function ($user, $chatRoomId) {
    return $user->rooms()->where('id', $chatRoomId)->exists();
});
