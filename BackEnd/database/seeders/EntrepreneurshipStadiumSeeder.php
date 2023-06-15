<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EntrepreneurshipStadium;

class EntrepreneurshipStadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = EntrepreneurshipStadium::create(['name' => 'Idea', 'state'=>1]);
        $role = EntrepreneurshipStadium::create(['name' => 'Proyecto en marcha', 'state'=>1]);
    }
}
