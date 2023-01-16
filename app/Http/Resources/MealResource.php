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

    public function toResponse($request)
    {
        $data = $this->resolve($request);
        if ($data instanceof Collection) {
            $data = $data->all();
        }

        $paginated = $this->resource->toArray();
        // perform a dd($paginated) to see how $paginated looks like

        $json = array_merge_recursive(
            [
                self::$wrap => $data
            ],
            [
                'links' => [
                    'first' => $paginated['first_page_url'] ?? null,
                    'last' => $paginated['last_page_url'] ?? null,
                    'prev' => $paginated['prev_page_url'] ?? null,
                    'next' => $paginated['next_page_url'] ?? null,
                ],
                'meta' => [
                    'current_page' => $metaData['current_page'] ?? null,
                    'total_items' => $metaData['total'] ?? null,
                    'per_page' => $metaData['per_page'] ?? null,
                    'total_pages' => $metaData['total'] ?? null,
                ],
            ],
            $this->with($request),
            $this->additional
        );


        return response()->json($json);
    }
}
