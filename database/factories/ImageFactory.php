<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fileName = $this->faker->numberBetween(1, 10) . '.jpg';
        return [
            // Lo dejaremos para el final por que las imagenes pueden pertencer tanto a products y los usuarios
            'path' => "img/products/{$fileName}",
        ];
    }

    public function user()
    {
        $fileName = $this->faker->numberBetween(1, 6) . '.jpg';
        return $this->state([
            'path' => "img/users/{$fileName}",
        ]);
    }
}
