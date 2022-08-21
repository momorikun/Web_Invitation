<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use illuminate\Support\Str;

class CeremonyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ceremony_id' => Str::random(10),
            'groom_name'  => $this->faker->name,
            'bride_name'  => $this->faker->name,
            'place_name'  => Str::random(10),
            'address'     => Str::random(10),
        ];
    }
}
