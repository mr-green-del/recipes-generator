<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IngredientResource;
use App\Http\Resources\IngredientTypeResource;
use App\Models\Ingredient;
use App\Models\IngredientType;
use App\Services\RecipeGeneratorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class RecipeController extends Controller
{
    public function actionMakeRecipe(string $ingredientCodes): JsonResponse
    {
        $recipeGenerator = new RecipeGeneratorService();
        try {
            $recipes = $recipeGenerator->make($ingredientCodes);
        } catch (BadRequestException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json($recipes);
    }

    public function actionIngredients(): AnonymousResourceCollection
    {
        return IngredientResource::collection(Ingredient::all());
    }

    public function actionIngredientTypes(): AnonymousResourceCollection
    {
        return IngredientTypeResource::collection(IngredientType::all());
    }
}
