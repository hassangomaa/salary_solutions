<?php

namespace Database\Seeders;

use App\Models\Deduction;
use App\Models\Incentives;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncentiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Incentives::factory(50)->create();

    }
}
