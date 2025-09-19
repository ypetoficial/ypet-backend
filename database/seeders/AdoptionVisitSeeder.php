<?php

namespace Database\Seeders;

use App\Models\AdoptionVisit;
use Illuminate\Database\Seeder;

class AdoptionVisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdoptionVisit::factory()->create();
    }
}
