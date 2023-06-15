<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DevelopmentDegree;

class DevelopmentDegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $development_degree = DevelopmentDegree::create(['name' => 'Prototipo', 'state'=>1]);
        $development_degree = DevelopmentDegree::create(['name' => 'Comercializando', 'state'=>1]);
    }
}
