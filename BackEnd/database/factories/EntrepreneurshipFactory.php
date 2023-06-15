<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EntrepreneurshipFactory extends Factory
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
            'proposed_solution' => $this->faker->paragraph(70),
            'products_services_you_offer' => $this->faker->paragraph(30),
            'market' => $this->faker->paragraph(20),
            'action_plan' => $this->faker->paragraph(40),
            'image' => $this->faker->numberBetween(0,10),
            'condition' => 'accepted',
            'user_id' => $this->faker->numberBetween(1,50),
            'edition_id' => $this->faker->numberBetween(1,3),
            'state' => 1,
            'slug' => $slug
        ];
    }
}
