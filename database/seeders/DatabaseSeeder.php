<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Location;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            InventorySeeder::class,
            LocationSeeder::class,
        ]);

        Inventory::factory(50)->recycle([
            Location::all()
        ])->create();
    }
}
