<?php

namespace Database\Seeders;

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
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        // $this->call(ApprovedBankSeeder::class);
        // $this->call(BrochureRequestSeeder::class);
        // $this->call(HomepageBannerSeeder::class);
        // $this->call(HomepageSettingSeeder::class);
        // $this->call(ImageSeeder::class);
        // $this->call(NearByLocationSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(VillaSeeder::class);
        // $this->call(VillaImageSeeder::class);
    }
}
