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
        return [
            'author_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence(),
            'content'=>$this->faker->text(),
            'acteurs'=>$this->faker->name(),
            'url'=>$this->faker->url(),
            'tags'=>$this->faker->text(),
            'date'=>$this->faker->date(),
            'status'=>'published'
        ];
    }
}
