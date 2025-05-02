<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisibleToSeeder extends Seeder {
    public function run(): void {
        $userIds = DB::table('users')->pluck('id')->toArray();
        $eventIds = DB::table('events')->pluck('id')->toArray();

        foreach ($eventIds as $eventId) {
            $visibleUsers = collect($userIds)->random(3);
            foreach ($visibleUsers as $userId) {
                DB::table('visible_to')->insert([
                    'event_id' => $eventId,
                    'user_id' => $userId,
                ]);
            }
        }
    }
}
