<?php

use App\Http\Controllers\Api\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('recipes')->group(function () {
    Route::get('ingredients', [RecipeController::class, 'actionIngredients']);
    Route::get('ingredient_types', [RecipeController::class, 'actionIngredientTypes']);

    Route::post('make/{ingredientCodes}', [RecipeController::class, 'actionMakeRecipe'])
        ->whereAlpha('ingredientCodes');
});
