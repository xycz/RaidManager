<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WowclassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //        Wowclass::create([
            'name'  =>  ucfirst($this->faker->unique()->word()),
            'color' =>  $this->faker->unique()->word()
        ];
    }
}
