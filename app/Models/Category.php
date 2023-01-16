<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Translatable;
    public $timestamps = false;
    protected $table = 'categories';
    public $translatedAttributes = ['category_title'];
    protected $fillable = ['category_slug'];

    public function meal():BelongsTo
    {
        return $this -> belongsTo(Meal::class, 'category_id', 'id');
    }
}
