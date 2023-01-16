<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    use HasFactory,Translatable;
    public $timestamps = false;
    protected $table = 'ingredients';
    public $translatedAttributes = ['ingredient_title'];
    protected $fillable = ['ingredient_slug'];

    public function meal():BelongsToMany
    {
        return $this -> belongsToMany(Meal::class, 'meal_ingredients');
    }
}
