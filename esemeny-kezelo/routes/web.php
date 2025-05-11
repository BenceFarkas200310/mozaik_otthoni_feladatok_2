<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Pages;
use Illuminate\Support\Facades\Route;

Route::get('/', [Pages::class, 'home']);

Route::get('/login', [Pages::class, 'login']);
Route::get('/register', [Pages::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/all-events', [Pages::class, 'allEvents']);
Route::get('/event/{id}', [Pages::class, 'details']);
Route::get('/profile/{id}', [Pages::class, 'profile']);
Route::get('/search', [Pages::class, 'search']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/event/interested', [EventController::class, 'markInterested']);
Route::post('/events/create', [EventController::class, 'create']);
Route::post('/events/{id}/update', [EventController::class, 'update']);

Route::delete('/events/{id}/delete', [EventController::class, 'delete']);