<?php

namespace App\Http\Resources;

use Illuminate\Pagination\LengthAwarePaginator;

class CustomPagination extends LengthAwarePaginator
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'meta'=>[
                'currentPage' => $this->currentPage(),
                'totalItems' => $this->total(),
                'perPage' => $this->perPage(),
                'totalPages' => $this->lastPage(),
            ],
            'links' => [
                'prev' => $this->previousPageUrl(),
                'next' =>$this->nextPageUrl(),
            ],
        ];
    }
}
