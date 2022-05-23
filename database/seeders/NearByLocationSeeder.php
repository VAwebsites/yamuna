<?php

namespace Database\Seeders;

use App\Models\NearByLocation;
use Illuminate\Database\Seeder;

class NearByLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NearByLocation::factory()
            ->count(5)
            ->create();
    }
}
