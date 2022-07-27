<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // se necesita para falsear datos de la fecha no debe ir vacio
            // No hace nada pero igual nos permite crear una instacia
        ];
    }
}
