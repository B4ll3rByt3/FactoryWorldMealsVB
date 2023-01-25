<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Meal;
use App\Models\MealTag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MealTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meals = Meal::all();
        $tags = Tag::all();

        foreach ($meals as $meal) {
            foreach ($tags->random(2) as $tag) {
                MealTag::firstOrCreate([
                    'tag_id' => $tag->id,
                    'meal_id' => $meal->id,
                ]);
            }
        }
    }
}
