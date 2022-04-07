<?php

namespace Database\Seeders;

use App\Models\HomepageBanner;
use Illuminate\Database\Seeder;

class HomepageBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomepageBanner::factory()
            ->count(5)
            ->create();
    }
}
