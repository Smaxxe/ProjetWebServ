<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SerieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->words(random_int(3,6), true);
        return [
            'author_id' => \App\Models\User::factory(),
            'title' => $title, //$title est composé de 1 à 6 mots. words() au lieu de sentence() pour éviter le point final
            'content'=>$this->faker->text(),
            'acteurs'=>$this->faker->name(),
            'url'=>str_replace(' ', '_', $title), //Les espaces du titre sont remplacés par des '_' pour pouvoir utiliser cette variable comme url
            'tags'=>$this->faker->text(),
            //'date'=>$this->faker->date(),
            'status'=>'published'
        ];
    }
}
