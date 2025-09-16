<?php

namespace Database\Seeders;

use App\Models\Protector;
use Illuminate\Database\Seeder;

class ProtectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Protector::factory()->create();
    }
}
