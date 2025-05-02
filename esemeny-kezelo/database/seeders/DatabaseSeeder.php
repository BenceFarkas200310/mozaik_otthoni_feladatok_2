<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        \App\Models\User::factory(10)->create();
        $this->call([
            EventSeeder::class,
            CreatedBySeeder::class,
            VisibleToSeeder::class,
            InterestedSeeder::class,
        ]);
    }
};
