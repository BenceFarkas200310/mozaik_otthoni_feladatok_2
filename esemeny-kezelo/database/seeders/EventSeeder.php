<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventSeeder extends Seeder {
    public function run(): void {
        $types = ['koncert', 'konferencia', 'sport', 'expo', 'dedikálás', 'egyéb'];
        $locations = ['Budapest', 'Debrecen', 'Szeged', 'Pécs', 'Győr'];
        $userIds = DB::table('users')->pluck('id')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('events')->insert([
                'name' => 'Event ' . $i,
                'date' => Carbon::now()->addDays(rand(1, 100)),
                'location' => $locations[array_rand($locations)],
                'img' => 'event' . $i . '.jpg',
                'type' => $types[array_rand($types)],
                'description' => 'Description for event ' . $i,
                'author_id' => $userIds[array_rand($userIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
