<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IngredientTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['ingredient_title'];
}
