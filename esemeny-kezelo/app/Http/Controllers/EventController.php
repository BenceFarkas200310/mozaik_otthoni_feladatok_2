<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function markInterested(Request $request)
    {
        $userId = Auth::id();
        $eventId = $request->input('event_id');

        DB::table('interested')->insert([
            'user_id' => $userId,
            'event_id' => $eventId
        ]);
        return response()->json(['success' => true]);
    }
}
