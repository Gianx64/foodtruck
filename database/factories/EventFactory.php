<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
			'name' => $this->faker->name,
			'owner' => $this->faker->name,
			'date' => $this->faker->name,
			'address' => $this->faker->name,
			'description' => $this->faker->name,
        ];
    }
}
