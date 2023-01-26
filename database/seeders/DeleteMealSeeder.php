<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Seeder;
use Database\Factories\MealFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeleteMealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meal::factory()->count(100)->create();
    }
}
