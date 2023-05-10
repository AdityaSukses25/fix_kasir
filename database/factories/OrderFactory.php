<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reception_id' => mt_rand(2, 6),
            'service_id' => mt_rand(1, 12),
            'therapist_id' => mt_rand(1, 10),
            'place_id' => mt_rand(1, 5),
            'discount' => mt_rand(1, 10),
            'cust_name' => $this->faker->name(),
            'orderID' => mt_rand(1, 10),
            'phone' => $this->faker->phoneNumber(),
            'time' => 60,
            'price' => 200000,
            'payment_method' => 'cash',
            'description' => $this->faker->sentence(mt_rand(5, 10)),
            'summary' => mt_rand(150000, 200000),
            'start_service' => $this->faker->time(),
            'end_service' => $this->faker->time(),
            'Status' => 'finish',
        ];
    }
}
