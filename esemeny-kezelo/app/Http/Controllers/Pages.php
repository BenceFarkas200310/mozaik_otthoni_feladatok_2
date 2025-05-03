<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class Pages extends Controller
{
    public function login() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function home() {
        $events = Event::all();
        $publics = Event::where('is_public', true)->get();
        return view('home')->with('events', $events)->with('publics', $publics);
    }
}
