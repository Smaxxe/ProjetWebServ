<?php

namespace Database\Factories;

use App\Models\Serie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => User::factory(),
            'serie_id' => Serie::factory(),
            'content' => $this->faker->paragraph($nbSentences = 10, $variableNbSentences = true)
        ];
    }
}
