<?php

namespace Database\Seeders;

use App\Models\Sim;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sim::factory()->count(10)->create();
    }
}
