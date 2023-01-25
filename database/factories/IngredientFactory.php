<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $title_id_hr = 1;
        static $title_id_en = 1;
        static $slug_id = 1;
        $ingredient_title_hr = ['Naziv sastojka ' . $title_id_hr++ . ' na HR jeziku'];
        $ingredient_title_en = ['Naziv sastojka ' . $title_id_en++ . ' na EN jeziku'];
        $ingredient_slug = ['sastojak-' . $slug_id++];

        return
        [
            'ingredient_slug' => fake()->randomElement($ingredient_slug) ,
            'hr' => [
                'ingredient_title' => fake()->randomElement($ingredient_title_hr),],
            'en' => [
                'ingredient_title' => fake()->randomElement($ingredient_title_en),],
            ];
    }
}
