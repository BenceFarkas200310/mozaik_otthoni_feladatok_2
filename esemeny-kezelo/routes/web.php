<?php

use App\Http\Controllers\Pages;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [Pages::class, 'login']);
