<?php

namespace App\Http\Resources;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class MealResource extends JsonResource
{
    public $preserveKeys = true;
    public static $wrap = 'user';
    public function __construct($resource)
    {
        parent::__construct(...func_get_args());
        self::wrap('new-key');
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
        'id' => $this->id,
        'title' => $this->meal_title,
        'description' => $this->meal_description,
        'status' => $this->meal_status,
        'category'=> new CategoryResource($this->whenLoaded('category')),
        'tags'=> TagResource::collection($this->whenLoaded('tags')),
        'ingredients'=>IngredientResource::collection($this->whenLoaded('ingredients')),
        ];
    }

    public function withResponse($request, $response): void
    {
        $response->header('X-Value', 'True');
    }

    public function with($request): array
    {
        return [
            'meta' => [
                'relationships' => [
                    'posts',
                    'files',
                    'comments',
                ],
            ],
        ];
    }
}
