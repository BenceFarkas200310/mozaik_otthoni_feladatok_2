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

    public function userInterestedIn($userId) {
        return DB::table('events')
        ->join('interested', 'events.id', '=', 'interested.event_id')
        ->where('interested.user_id', $userId)
        ->get();
    }

    public function addVisibility($eventId, $users) {
        $entries = [];
        foreach ($users as $userId) {
            $entries[] = [
                'event_id' => $eventId,
                'user_id' => $userId
            ];
        }

        DB::table('visible_to')->insert($entries);
    }
}