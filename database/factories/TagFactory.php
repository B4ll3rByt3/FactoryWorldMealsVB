<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
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
        $tag_title_hr = ['Naziv kategorije ' . $title_id_hr++ . ' na HR jeziku'];
        $tag_title_en = ['Naziv kategorije ' . $title_id_en++ . ' na EN jeziku'];
        $tag_slug = ['tag-' . $slug_id++];

        return
        [
            'tag_slug' => fake()->randomElement($tag_slug) ,
            'hr' => [
                'tag_title' => fake()->randomElement($tag_title_hr),],
            'en' => [
                'tag_title' => fake()->randomElement($tag_title_en),],
        ];
    }
}
