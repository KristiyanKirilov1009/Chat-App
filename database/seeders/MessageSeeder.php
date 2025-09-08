<?php

namespace Database\Seeders;

use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $message = Message::create([
            'text' => 'I am Kikicha',
            'sender_id' => User::where('name', 'Kristiyan')->first()->id,
            'chat_room_id' => ChatRoom::first()->id
        ]);

        $message2 = Message::create([
            'text' => 'I am Gosh',
            'sender_id' => User::where('name', 'Georgi')->first()->id,
            'chat_room_id' => ChatRoom::first()->id
        ]);
    }
}
