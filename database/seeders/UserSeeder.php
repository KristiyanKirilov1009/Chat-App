<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ChatRoom;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Kristiyan',
            'email' => 'k.vladimirov2004@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password')
        ]);

        $user2 = User::create([
            'name' => 'Georgi',
            'email' => 'gosheto@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password')
        ]);

        $chatRoom = ChatRoom::first();

        $chatRoom->users()->attach([$user, $user2]);
    }
}
