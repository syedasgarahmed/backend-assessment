<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Timesheet;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimesheetFactory extends Factory
{
    protected $model = Timesheet::class;

    public function definition(): array
    {
        return [
            'task_name' => $this->faker->sentence(),
            'date' => $this->faker->date(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,  // Ensure user_id is provided
            'hours' => $this->faker->numberBetween(1, 8),
        ];
    }
}