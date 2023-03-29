<?php

namespace App\Services;

use App\Models\Ingredient;
use App\Models\IngredientType;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class RecipeGeneratorService
{
    /**
     * @param string $ingredientCodes
     * @throws BadRequestException
     *
     * @return array
     */
    public function make(string $ingredientCodes): array
    {
        // @todo В идеале переписать бы эту портянку на небольшие функции

        $ingredientCodesArray = str_split($ingredientCodes);
        $allIngredientCodes = IngredientType::query()
            ->pluck('code')
            ->toArray();

        $diff = array_diff(array_unique($ingredientCodesArray), $allIngredientCodes);

        if(!empty($diff)) {
            throw new BadRequestException(
                "Таких ингредиентов нет на кухне: '". implode($diff) ."'"
            );
        }

        $ingredientTypes = IngredientType::query()
            ->whereIn('code', $ingredientCodesArray)
            ->with('ingredients')
            ->get();

        $ingredientsWithTypes = [];

        foreach ($ingredientTypes as $ingredientType) {
            $ingredientsWithTypes[$ingredientType->code] = $ingredientType
                ->ingredients
                ->map(fn(Ingredient $ingredient) => [
                    'type' => $ingredientType->title,
                    'value' => $ingredient->title,
                    'price' => $ingredient->price,
                ])
                ->toArray();
        }

        return $this->generateRecipes($ingredientsWithTypes, $ingredientCodesArray);
    }

    protected function generateRecipes(array $ingredientsTypes, array $ingredientCodesArray): array
    {
        $recipes = [];
        $baseRecipeItem = ['products' => [], 'price' => 0];
        $recipeIngredients = [];

        foreach ($ingredientsTypes as $code => $ingredients) {
            foreach ($ingredientCodesArray as $ingredientCode) {
                if ($code === $ingredientCode) { // Добавляем ингредиенты если код повторяется
                    $recipeIngredients[] = $ingredients;
                }
            }
        }

        $rawRecipes = $this->getIngredientCombinations($recipeIngredients);

        foreach ($rawRecipes as $rawRecipe) {
            $tmp = $baseRecipeItem;

            foreach ($rawRecipe as $ingredient) {
                $tmp['price'] += $ingredient['price'];
                unset($ingredient['price']);
                $tmp['products'][] = $ingredient;
            }

            $recipes[] = $tmp;
        }

        return $recipes;
    }

    protected function getIngredientCombinations(array $recipeIngredients): array
    {
        $recipes = [[]];

        foreach ($recipeIngredients as $ingredients) {
            $tmp = [];

            foreach ($recipes as $recipeItem) {
                foreach ($ingredients as $ingredient) {
                    if (in_array($ingredient, $recipeItem)) {
                        continue;
                    }

                    $newRecipeItem = array_merge($recipeItem, [$ingredient]);
                    array_multisort($newRecipeItem, SORT_DESC);

                    if (in_array($newRecipeItem, $tmp)) {
                        continue;
                    }

                    $tmp[] = $newRecipeItem;
                }
            }

            $recipes = $tmp;
        }

        return $recipes;
    }
}
