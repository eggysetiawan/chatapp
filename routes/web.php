<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\TestMessageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
    return Inertia::render('Chat/Container');
})->name('chat');

Route::middleware('auth:sanctum')->get('/chat/rooms', [ChatController::class, 'rooms'])->name('chat.rooms');
Route::middleware('auth:sanctum')->get('/chat/room/{chatRoom:slug}/messages', [ChatController::class, 'messages'])->name('chat.message');
Route::middleware('auth:sanctum')->post('/chat/room/{chatRoom:slug}/message', [ChatController::class, 'newMessage'])->name('chat.newMessage');

Route::middleware('auth:sanctum')->resource('test', TestMessageController::class);
