<?php

namespace Database\Factories;

use App\Models\Spec;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ms_id' => Spec::factory(),
            'os_id' => Spec::factory(),
            'user_id' => User::factory(),
            'name'  =>  ucfirst($this->faker->firstName()),
        ];
    }
}
