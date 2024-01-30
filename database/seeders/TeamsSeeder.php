<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('teams')->insert([
            ['name' => 'Galatasaray', 'strength' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fenerbahçe', 'strength' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beşiktaş', 'strength' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Trabzonspor', 'strength' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
