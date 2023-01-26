<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealIngredient extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    public $incrementing = true;

    public function meal(): BelongsTo
    {
        return $this -> belongsTo(Meal::class, 'id', 'meal_id')->withSoftDeletes();
    }
    public function ingredients(): BelongsTo
    {
        return $this -> belongsTo(Ingredient::class, 'id', 'ingredient_id');
    }
}
