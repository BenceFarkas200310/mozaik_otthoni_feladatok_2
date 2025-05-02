<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatedBySeeder extends Seeder {
    public function run(): void {
        $userIds = DB::table('users')->pluck('id')->toArray();
        $eventIds = DB::table('events')->pluck('id')->toArray();

        foreach ($eventIds as $eventId) {
            DB::table('created_by')->insert([
                'user_id' => $userIds[array_rand($userIds)],
                'event_id' => $eventId,
            ]);
        }
    }
}
