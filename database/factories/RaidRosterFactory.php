<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RaidRosterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            /* Consider refactoring character_id to be relative */
            'character_id' => $this->faker->unique()->numberBetween(1, 16),
            'buff_assigned'  =>  $this->faker->boolean(50),
            'is_backup' => $this->faker->boolean(50)
        ];
    }
}
