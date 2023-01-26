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
        $curent_page = $this->currentPage();
        $total_page = $this->lastPage();
        $currentURL = str_replace(['&page=' . $curent_page], '', URL::full()) . '&page=' . $curent_page;
        $nextURL = str_replace(['&page=' . $curent_page], '', URL::full()) . '&page=' . $curent_page + 1;
        if ($curent_page == $total_page) {
            $nextURL = null;
        } else {
            $nextURL = str_replace(['&page=' . $curent_page], '', URL::full()) . '&page=' . $curent_page + 1;
        }

        if ($this->currentPage() == 1) {
            $prevPage = null;
        } else {
            $prevPage = str_replace(['&page=' . $curent_page], '', URL::full()) . '&page=' . $curent_page - 1;
        }

        if ($curent_page > $total_page) {
            $response = [
                'message' => 'Upisan je broj stranica veci od maximalnog broja stranica',
            ];
            return response()->json($response);
        }
        return [
            'meta' => [
                'currentPage' => $curent_page,
                'totalItems' => $this->total(),
                'perPage' => $this->perPage(),
                'totalPages' => $this->lastPage(),
            ],
            'data' => $this->collection,
            'links' => [
                'prev' => str_replace('%2C', ',', $prevPage),
                'next' => str_replace('%2C', ',', $nextURL),
                'self' => str_replace('%2C', ',', $currentURL),
            ],
        ];
    }
}
