<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IngredientType extends Model
{
    use HasFactory;

    protected $table = 'ingredient_types';

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class, 'ingredient_type_id');
    }
}
