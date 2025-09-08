<?php

namespace App\Events;

use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public readonly Message $message)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        Log::info('BroadcastOn called for MessageSent event', ['message_id' => $this->message->id]);

        return [
            new PrivateChannel('chat.' . $this->message->chat_room_id)
        ];
    }

    public function broadcastWith()
    {
        return [
            'sender' => $this->message->sender,
            'receiver' => $this->message->chatRoom->users()->where('id', '!=', auth()->id())->get(),
            'text' => $this->message->text,
            'chat_room_id' => $this->message->chatRoom->id
        ];
    }

    public function broadcastAs()
    {
        return 'sent';
    }
}
