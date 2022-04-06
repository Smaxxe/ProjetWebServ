<?php

namespace Database\Factories;

use App\Models\Serie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'serie_id' => Serie::factory(),
            'valeurNote' => $this->faker->numberBetween(0,10)
        ];
    }
}
