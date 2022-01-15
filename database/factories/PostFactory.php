<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $random_date = $this->faker->dateTimeBetween('-1year','-1day');

        return [
            'title' => $this->faker->realText(rand(10, 15)),
            'point1' => $this->faker->realText(rand(10, 15)),
            'point2' => $this->faker->realText(rand(10, 15)),
            'point3' => $this->faker->realText(rand(10, 15)),
            'point4' => $this->faker->realText(rand(10, 15)),
            'point5' => $this->faker->realText(rand(10, 15)),
            'content1' => $this->faker->realText(rand(200, 300)),
            'content2' => $this->faker->realText(rand(200, 300)),
            'content3' => $this->faker->realText(rand(200, 300)),
            'content4' => $this->faker->realText(rand(200, 300)),
            'content5' => $this->faker->realText(rand(200, 300)),
            'thoughts' => $this->faker->realText(rand(200, 300)),
            'user_id' => $this->faker->numberBetween(1,3),
            'created_at' => $random_date,
            'updated_at' => $random_date
        ];
    }
}
