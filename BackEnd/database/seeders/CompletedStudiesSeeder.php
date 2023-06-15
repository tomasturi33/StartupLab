<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompletedStudies;

class CompletedStudiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompletedStudies::create([ 'name' => 'Secundario', 'state'=> 1]);
        CompletedStudies::create([ 'name' => 'Terciario', 'state'=> 1]);
        CompletedStudies::create([ 'name' => 'Grado en curso', 'state'=> 1]);
        CompletedStudies::create([ 'name' => 'Grado finalizado', 'state'=> 1]);
    }
}
