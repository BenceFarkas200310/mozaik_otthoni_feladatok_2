<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Services\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Pages extends Controller
{
    private $publics;
    private $privateEvents;
    private $eventService;

    public function __construct(
        EventService $eventService
    )
    {
        $this->publics = Event::where('is_public', true)->get();
        $userId = Auth::id();
        $this->privateEvents = Event::where('is_public', false)
        ->whereHas('visibleTo', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
        $this->eventService = $eventService;
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
        $isInterested = $this->eventService->alreadyInterested($id);
        $howManyInterested = DB::table('interested')->where('event_id', $id)->count();
        $allUsers = User::all();
        return view('event-details')
        ->with('event', $event)
        ->with('isInterested', $isInterested)
        ->with('howManyInterested', $howManyInterested)
        ->with('allUsers', $allUsers);
    }

    public function profile($id) {
        $user = User::findOrFail($id);
        $usersEvents = Event::where('author_id', $id)->get();
        $userInterested = $this->eventService->userInterestedIn($id);
        $allUsers = User::all();
        return view('profile')
        ->with('user', $user)
        ->with('usersEvents', $usersEvents)
        ->with('userInterested', $userInterested)
        ->with('allUsers', $allUsers);
    }

    public function search() {
        $userId = Auth::id();
        $events = Event::where('is_public', true)
        ->orWhereHas('visibleTo', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->get();

        return view('search', ['events' => $events]);
    }
}
