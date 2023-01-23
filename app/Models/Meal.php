<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meal extends Model
{
    use HasFactory, SoftDeletes, Translatable;
    protected $table = 'meals';
    protected $primaryKey = 'id';
    public $translatedAttributes = ['meal_title', 'meal_description'];
    protected $fillable = ['meal_status', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
    public $timestamps = false;

    public function category():HasOne
    {
        return $this -> hasOne(Category::class, 'id', 'category_id');
    }
    public function tags():BelongsToMany
    {
        return $this -> belongsToMany(Tag::class, 'meal_tags');
    }

    public function ingredients():BelongsToMany
    {
        return $this -> belongsToMany(Ingredient::class, 'meal_ingredients')
                     ->withTrashed();
    }
}
