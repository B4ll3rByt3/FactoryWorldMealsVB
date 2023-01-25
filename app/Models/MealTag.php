<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealTag extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    public $incrementing = true;
    protected $dates = ['deleted_at'];
}
