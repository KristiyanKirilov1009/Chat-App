<?php

namespace App\Console\Commands;

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Console\Command;

class GenerateChatRoomsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-chat-rooms-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        for($i = 0; $i < count($users) - 1; $i++){
            for($j = $i + 1; $j < count($users); $j++){
                $chatRoom = ChatRoom::create();
                $chatRoom->users()->attach([$users[$i], $users[$j]]);
            }
        }
    }
}
