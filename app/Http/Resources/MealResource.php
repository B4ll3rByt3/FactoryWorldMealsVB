<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
        'meal_id' => $this->id,
        'title' => $this->meal_title,
        'status' => $this->meal_status,
        'description' => $this->meal_description,
        'category'=> new CategoryResource($this->whenLoaded('category')),
        'tags'=> TagResource::collection($this->whenLoaded('tags')),
        'ingredients'=>IngredientResource::collection($this->whenLoaded('ingredients')),
        ];
    }
}
