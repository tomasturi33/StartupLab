<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VerticalWorks;

class VerticalWorksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vertical_work = VerticalWorks::create(['name' => 'Vertical 1', 'state'=>1]);
        $vertical_work = VerticalWorks::create(['name' => 'Vertical 2', 'state'=>1]);
        $vertical_work = VerticalWorks::create(['name' => 'Vertical 3', 'state'=>1]);
        $vertical_work = VerticalWorks::create(['name' => 'Vertical 4', 'state'=>1]);
        $vertical_work = VerticalWorks::create(['name' => 'Vertical 5', 'state'=>1]);
    }
}
