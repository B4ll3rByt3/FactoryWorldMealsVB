<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ids = Category::pluck('id')->toArray();
        static $title_id_hr = 1;
        static $title_id_en = 1;
        static $description_id_hr = 1;
        static $description_id_en = 1;
        $meal_title_hr = ['Naziv jela ' . $title_id_hr++ . ' na HR jeziku'];
        $meal_title_en = ['Naziv jela ' . $title_id_en++ . ' na EN jeziku'];
        $meal_description_hr = ['Opis jela ' . $description_id_hr++ . ' na HR jeziku'];
        $meal_description_en = ['Opis jela ' . $description_id_en++ . ' na EN jeziku'];
        $created_at = fake()->dateTime();
        $updated_at = fake()->optional(0.4, null)->dateTimeBetween($created_at, '+20 days');
        $deleted_at = fake()->optional(0.4, null)->dateTimeBetween($updated_at, '+20 days');

        $meal = [
            'hr' => [
                'meal_title'  => fake()->randomElement($meal_title_hr),
                'meal_description' => fake()->randomElement($meal_description_hr),],
            'en' => [
                'meal_title'  => fake()->randomElement($meal_title_en),
                'meal_description' => fake()->randomElement($meal_description_en),],
            'category_id' => fake()->optional(0.6, null)->randomElement($ids),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];

        if ($meal['updated_at'] !== null) {
            $meal['deleted_at'] = $deleted_at;
        }

        if ($meal['updated_at'] !== null and $meal['deleted_at'] !== null) {
            $meal['meal_status'] = 'deleted';
        } elseif ($meal['updated_at'] !== null and $meal['deleted_at'] === null) {
            $meal['meal_status'] = 'updated';
        } else {
            $meal['meal_status'] = 'created';
        }

        return $meal;
    }
}
