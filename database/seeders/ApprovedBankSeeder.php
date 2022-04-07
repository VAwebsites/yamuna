<?php

namespace Database\Seeders;

use App\Models\ApprovedBank;
use Illuminate\Database\Seeder;

class ApprovedBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApprovedBank::factory()
            ->count(5)
            ->create();
    }
}
