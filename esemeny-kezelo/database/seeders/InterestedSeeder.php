<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestedSeeder extends Seeder {
    public function run(): void {
        $userIds = DB::table('users')->pluck('id')->toArray();
        $eventIds = DB::table('events')->pluck('id')->toArray();

        foreach ($userIds as $userId) {
            $interestedEvents = collect($eventIds)->random(2);
            foreach ($interestedEvents as $eventId) {
                DB::table('interested')->insert([
                    'event_id' => $eventId,
                    'user_id' => $userId,
                ]);
            }
        }
    }
}
