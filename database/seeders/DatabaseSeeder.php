<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Purok;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
        ]);

        Purok::create([
            'name' => 'Purok 1',
        ]);

        Purok::create([
            'name' => 'Purok 2',
        ]);

        Purok::create([
            'name' => 'Purok 3',
        ]);

        Purok::create([
            'name' => 'Purok 4',
        ]);

        Purok::create([
            'name' => 'Purok 5',
        ]);

        Purok::create([
            'name' => 'Purok 6',
        ]);
    }
}
