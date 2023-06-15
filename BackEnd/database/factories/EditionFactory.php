<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EditionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = 'Edicion 2022';
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'description' => $this->faker->paragraph(),
            'start_date' =>now(),
            'start_time' =>'07:30',
            'finish_date' => now(),
            'finish_time' => '21:00',
            'pre_incubation' => true,
            'incubation' => true,
            'pre_aceleration' => true,
            'published' => true,
            'slug' => $slug,
            'state' => 1,
        ];
    }
}
