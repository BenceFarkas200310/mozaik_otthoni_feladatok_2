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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/event/interested', [EventController::class, 'markInterested']);