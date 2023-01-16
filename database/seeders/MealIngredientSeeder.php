<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Models\Ingredient;
use App\Models\MealIngredient;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MealIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meals = Meal::all();
        $ingrediants = Ingredient::all();

        foreach ($meals as $meal) {
            foreach ($ingrediants->random(3) as $ingrediant) {
                MealIngredient::firstOrCreate([
                    'ingredient_id' => $ingrediant->id,
                    'meal_id' => $meal->id,
                ]);
            }
        }
    }
}
