<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventService
{
    public function alreadyInterested($eventId)
    {
        $userId = Auth::id();

        return DB::table('interested')
            ->where('user_id', $userId)
            ->where('event_id', $eventId)
            ->exists();
    }
}