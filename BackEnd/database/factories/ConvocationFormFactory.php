<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ConvocationFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        $slug = Str::slug($title);

        return [
            'title' => $title,
            'executive_summary' => $this->faker->paragraph(50),
            'problem_detected' => $this->faker->paragraph(40),
            'proposed_solution' => $this->faker->paragraph(45),
            'products_services_you_offer' => $this->faker->paragraph(30),
            'entrepreneurial_team' => $this->faker->paragraph(25),
            'market' => $this->faker->paragraph(20),
            'action_plan' => $this->faker->paragraph(40),
            'condition' => $this->faker->randomElement(['in_progress', 'pending', 'rejected']),
            'user_id' => $this->faker->numberBetween(1,10),
            'edition_id' => 1,
            'vertical_works_id' => $this->faker->numberBetween(1,5),
            'provincia_id' => 22,
            'localidad_id' => $this->faker->randomElement([1885,2104]),

            'entrepreneurship_stadia_id' => $this->faker->numberBetween(1,2),
            'development_degrees_id' => $this->faker->numberBetween(1,2),

            'is_sent' => 1,
            'state' => 1,
        ];
    }
}
