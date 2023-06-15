<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gender;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::create(['name' => 'Mujer', 'state'=> 1]);
        Gender::create(['name' => 'Mujer trans', 'state'=> 1]);
        Gender::create(['name' => 'No binarie', 'state'=> 1]);
        Gender::create(['name' => 'Varón', 'state'=> 1]);
        Gender::create(['name' => 'Varón trans', 'state'=> 1]);
        Gender::create(['name' => 'Trans', 'state'=> 1]);
        Gender::create(['name' => 'Trans no binarie', 'state'=> 1]);
        Gender::create(['name' => 'Travesti', 'state'=> 1]);
        Gender::create(['name' => 'Otros', 'state'=> 1]);
    }
}
