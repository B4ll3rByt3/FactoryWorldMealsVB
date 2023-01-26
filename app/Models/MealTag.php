<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealTag extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = true;
}
