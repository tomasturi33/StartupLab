<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provincia;

class ProvinciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincia::create(['name' => 'Buenos Aires', 'state'=> 1]);
        Provincia::create(['name' => 'Buenos Aires-GBA', 'state'=> 1]);
        Provincia::create(['name' => 'Capital Federal', 'state'=> 1]);
        Provincia::create(['name' => 'Catamarca', 'state'=> 1]);
        Provincia::create(['name' => 'Chaco', 'state'=> 1]);
        Provincia::create(['name' => 'Chubut', 'state'=> 1]);
        Provincia::create(['name' => 'Córdoba', 'state'=> 1]);
        Provincia::create(['name' => 'Corrientes', 'state'=> 1]);
        Provincia::create(['name' => 'Entre Ríos', 'state'=> 1]);
        Provincia::create(['name' => 'Formosa', 'state'=> 1]);
        Provincia::create(['name' => 'Jujuy', 'state'=> 1]);
        Provincia::create(['name' => 'La Pampa', 'state'=> 1]);
        Provincia::create(['name' => 'La Rioja', 'state'=> 1]);
        Provincia::create(['name' => 'Mendoza', 'state'=> 1]);
        Provincia::create(['name' => 'Misiones', 'state'=> 1]);
        Provincia::create(['name' => 'Neuquén', 'state'=> 1]);
        Provincia::create(['name' => 'Río Negro', 'state'=> 1]);
        Provincia::create(['name' => 'Salta', 'state'=> 1]);
        Provincia::create(['name' => 'San Juan', 'state'=> 1]);
        Provincia::create(['name' => 'San Luis', 'state'=> 1]);
        Provincia::create(['name' => 'Santa Cruz', 'state'=> 1]);
        Provincia::create(['name' => 'Santa Fe', 'state'=> 1]);
        Provincia::create(['name' => 'Santiado', 'state'=> 1]);
        Provincia::create(['name' => 'Tierra del Fuego, Antártida e Isla del Atlántico Sur', 'state'=> 1]);
        Provincia::create(['name' => 'Tucumán', 'state'=> 1]);
    }
}
