<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{

    private $eventService;
    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }
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

    public function create(Request $request) {
        $validatedData = $request->validate([
            'event-name' => 'required|string|max:255',
            'event-type' => 'required|string',
            'event-date' => 'required|date_format:Y-m-d\TH:i',
            'event-location' => 'required|string|max:255',
            'event-description' => 'nullable|string',
            'selected_users' => 'nullable|string',
        ]);

        $selectedUsers = json_decode($request->input('selected_users'), true);

        $author_id = Auth::id();
        $event = Event::create([
            'name' => $validatedData['event-name'],
            'type' => $validatedData['event-type'],
            'date' => \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['event-date'])->format('Y-m-d H:i:s'),
            'location' => $validatedData['event-location'],
            'description' => $validatedData['event-description'],
            'is_public' => $request->has('is_public')? true : false,
            'author_id' => $author_id,
            
        ]);

        if (!empty($selectedUsers)) {
            $this->eventService->addVisibility($event->id, $selectedUsers);
        }

        $eventCard = view('components.event-card', ['event' => $event])->render();

        return response()->json(['success' => true, 'event' => $event, 'eventCard' => $eventCard]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'event-name' => 'required|string|max:255',
            'event-type' => 'required|string',
            'event-date' => 'required|date_format:Y-m-d\TH:i',
            'event-location' => 'required|string|max:255',
            'event-description' => 'nullable|string',
            'selected_users' => 'nullable|string',
        ]);

        $event = Event::findOrFail($id);

        $event->update([
            'name' => $validatedData['event-name'],
            'type' => $validatedData['event-type'],
            'date' => $validatedData['event-date'],
            'location' => $validatedData['event-location'],
            'description' => $validatedData['event-description'],
            'is_public' => $request->has('is_public'),
        ]);

        if ($request->filled('selected_users')) {
            $selectedUsers = json_decode($request->input('selected_users'), true);
            $event->visibleTo()->sync($selectedUsers);
        }

        $badgeHtml = view('components.badge', ['event' => $event])->render();

        return response()->json([
            'success' => true,
            'event' => $event,
            'badge' => $badgeHtml
        ]);
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        
        return response()->json(['success' => true]);
    }

}
