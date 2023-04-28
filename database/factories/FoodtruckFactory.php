<?php

namespace Database\Factories;

use App\Models\Foodtruck;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FoodtruckFactory extends Factory
{
    protected $model = Foodtruck::class;

    public function definition()
    {
        return [
			'event_id' => $this->faker->name,
			'name' => $this->faker->name,
			'plate' => $this->faker->name,
			'owner' => $this->faker->name,
			'food' => $this->faker->name,
			'description' => $this->faker->name,
        ];
    }
}
