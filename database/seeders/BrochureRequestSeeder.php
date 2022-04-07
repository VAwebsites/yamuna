<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BrochureRequest;

class BrochureRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BrochureRequest::factory()
            ->count(5)
            ->create();
    }
}
