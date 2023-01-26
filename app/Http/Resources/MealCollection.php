<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MealCollection extends ResourceCollection
{
    public function paginationInformation($request, $paginated, $default)
    {
        unset($default['links']);
        unset($default['meta']);
        return $default;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $currentURL = URL::full();
        $nextURL = URL::full() + $request->page;
        return [
            'meta' => [
                'currentPage' => $this->currentPage(),
                'totalItems' => $this->total(),
                'perPage' => $this->perPage(),
                'totalPages' => $this->lastPage(),
            ],
            'data' => $this->collection,
            'links' => [
                'prev' => $currentURL,
                'next' => $nextURL,
            ],
        ];
    }
}
