<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    use Translatable;

    public $timestamps = false;
    public $translatedAttributes = ['tag_title'];
    protected $fillable = ['slug'];

    public function meal(): BelongsToMany
    {
        return $this -> belongsToMany(Meal::class, 'meal_tags');
    }
}
