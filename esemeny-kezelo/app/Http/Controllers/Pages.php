<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Pages extends Controller
{
    private $publics;
    private $privateEvents;

    public function __construct()
    {
        $this->publics = Event::where('is_public', true)->get();
        $userId = Auth::id();
        $this->privateEvents = Event::where('is_public', false)
        ->whereHas('visibleTo', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
    }
    public function login() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function home() {
        return view('home')->with('publics', $this->publics->slice(-8))->with('privates', $this->privateEvents);
    }

    public function allEvents() {
        return view('all-events')->with('publics', $this->publics)->with('privates', $this->privateEvents);
    }

    public function details($id) {
        $event = Event::findOrFail($id);
        return view('event-details')->with('event', $event);
    }
}
