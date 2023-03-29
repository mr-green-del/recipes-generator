<?php

namespace App\Http\Resources;

use App\Models\Ingredient;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
{
    /** @var $resource Ingredient */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'title' => $this->resource->title,
            'price' => $this->resource->price,
            'ingredientType' => IngredientTypeResource::make(
                $this->resource->ingredientType()->first()
            ),
        ];
    }
}
