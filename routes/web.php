<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth')->group(function () {
    // File management routes
    Route::get('/files', [FileController::class, 'index']);
    Route::post('/files/upload', [FileController::class, 'upload']);
    Route::get('/files/view/{filename}', [FileController::class, 'view']);
    Route::delete('/files/delete/{filename}', [FileController::class, 'delete']);

    // Post management routes
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});
Route::get('/test/{name}', function($name){
    return view('test', ["name" => $name]);
});