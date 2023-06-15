<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EntrepreneurshipNeed;

class EntrepreneurshipNeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $need = EntrepreneurshipNeed::create(['name' => 'Capital', 'state'=>1]);
        $need = EntrepreneurshipNeed::create(['name' => 'Capaciotaciones', 'state'=>1]);
        $need = EntrepreneurshipNeed::create(['name' => 'Landing Empresarial', 'state'=>1]);
        $need = EntrepreneurshipNeed::create(['name' => 'Redes de contactos', 'state'=>1]);
    }
}
