<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PartnerPreference;

class PartnerPreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PartnerPreference::factory()
            ->count(20)
            ->create();
    }
}
