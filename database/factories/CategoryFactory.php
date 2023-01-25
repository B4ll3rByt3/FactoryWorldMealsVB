<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
        $category_title_hr = ['Naziv kategorije ' . $title_id_hr++ . ' na HR jeziku'];
        $category_title_en = ['Naziv kategorije ' . $title_id_en++ . ' na EN jeziku'];
        $category_slug = ['category-' . $slug_id++];

        return
        [
            'category_slug' => fake()->randomElement($category_slug) ,
            'hr' => [
                'category_title' => fake()->randomElement($category_title_hr),],
            'en' => [
                'category_title' => fake()->randomElement($category_title_en),],
        ];
    }
}
