<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DeleteMealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $meal = [
            'updated_at' => fake()->optional(0.6, null)->dateTime(),
        ];

        if ($meal['updated_at'] !== null) {
            $meal['deleted_at'] = fake()->optional(0.4, null)->dateTime();
        }

        if ($meal['updated_at'] !== null and $meal['deleted_at'] !== null) {
            $meal['meal_status'] = 'deleted';
        } elseif ($meal['updated_at'] !== null and $meal['deleted_at'] === null) {
            $meal['meal_status'] = 'updated';
        }

        return $meal;
    }
}
