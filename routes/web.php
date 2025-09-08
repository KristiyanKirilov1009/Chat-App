<?php

use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();

        $lastMessage = auth()->user()->messages()->latest()->first();
        $chatRoom = $lastMessage ? $lastMessage->chatRoom : null;

        // dd($defaultRoom);

        return view('home', compact('users', 'chatRoom'));
    })->name('dashboard');

    // Route::get('/chatRooms/users/{user}', [ChatRoomController::class, 'createOrGet'])->name('createOrGet');
    // Route::get('/chatRooms/{chatRoom}', [ChatRoom::class, 'show'])->name('chatRooms.show');

    Route::get('/chatRooms/{chatRoom}', [ChatRoomController::class, 'show'])->name('chatRooms.show');
    Route::post('/messages', [MessageController::class, 'store'])->name('message.send');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
