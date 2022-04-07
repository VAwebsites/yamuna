<?php

namespace Database\Seeders;

use App\Models\VillaImage;
use Illuminate\Database\Seeder;

class VillaImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VillaImage::factory()
            ->count(5)
            ->create();
    }
}
