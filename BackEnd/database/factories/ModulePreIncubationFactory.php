<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModulePreIncubationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence();
        $slug = Str::slug($name);

        return [
            'order' => $this->faker->numberBetween(1,99),
            'name' => $name,
            'description' => $this->faker->paragraph(20),
            'edition_id' => 1,
            'state' => 1,
            'slug' => $slug
        ];
    }
}
