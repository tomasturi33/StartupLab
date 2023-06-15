<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            RoleSeeder::class,
            VerticalWorksSeeder::class,
            ProvinciasSeeder::class,
            LocalidadesSeeder::class,
            EntrepreneurshipStadiumSeeder::class,
            DevelopmentDegreeSeeder::class,
            AcademicUnitsSeeder::class,
            CareersSeeder::class,
            CompletedStudiesSeeder::class,
            EntrepreneurshipNeedSeeder::class,
            GenderSeeder::class
        ]);


        \App\Models\User::factory(10)->create();
        \App\Models\Edition::factory(1)->create();
        \App\Models\ModulePreIncubation::factory(8)->create();
        \App\Models\ConvocationForm::factory(20)->create();
        //\App\Models\Entrepreneurship::factory(60)->create();
        
    }
}
