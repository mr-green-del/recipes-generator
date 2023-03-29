<?php

namespace App\Http\Resources;

use App\Models\IngredientType;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientTypeResource extends JsonResource
{
    /** @var $resource IngredientType */
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
            'code' => $this->resource->code,
        ];
    }
}
