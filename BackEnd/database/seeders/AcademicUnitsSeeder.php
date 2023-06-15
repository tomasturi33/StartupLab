<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicUnit;

class AcademicUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AcademicUnit::create(['name' => 'Centro Universitario Reconquista – Avellaneda', 'initials' => 'CURA', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Centro Universitario Gálvez', 'initials' => 'CUG', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Sede UNL Rafaela – Sunchales', 'initials' => 'CURS', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Facultad de Arquitectura, Diseño y Urbanismo', 'initials' => 'FADU', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Facultad de Bioquímica y Ciencias Biológicas', 'initials' => 'FBCB', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Facultad de Ciencias Agrarias', 'initials' => 'FCA', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Facultad de Ciencias Económicas', 'initials' => 'FCE', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Facultad de Ciencias Jurídicas y Sociales', 'initials' => 'FCJS', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Facultad de Ciencias Médicas', 'initials' => 'FCM', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Facultad de Ciencias Veterinarias', 'initials' => 'FCV', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Facultad de Humanidades y Ciencias', 'initials' => 'FHUC', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Facultad de Ingeniería Química', 'initials' => 'FIQ', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Facultad de Ingenieria y Ciencias Hidricas', 'initials' => 'FICH', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Escuela Superior de Sanidad “Ramón Carrillo”', 'initials' => 'ESS', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Instituto Superior de Música', 'initials' => 'ISM', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Escuela Industrial Superior', 'initials' => 'EIS', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Escuela de Agricultura, Ganadería y Granja', 'initials' => 'EAGG', 'state'=> 1]);
        AcademicUnit::create(['name' => 'Escuela Secundaria de la UNL', 'initials' => 'ES-UNL', 'state'=> 1]);
    }
}
