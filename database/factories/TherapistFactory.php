<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TherapistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'nickname' => $this->faker->name(mt_rand(3, 5)),
            'phone' => '081123098234',
            'gender' => 'male',
            'status' => mt_rand(2, 3),
            'commision' => '40000',
        ];
    }
}
