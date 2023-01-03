<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $filtered = $this->collection->map(function ($item, $key) {
            return collect($item)->except(['book_number']);
        });

        $r = collect($this->resource)->toArray();
        unset($r['data']);
        return array_merge(
                ['data' => $filtered],
                $r
        );
        // return parent::toArray($request);
        // $mergedCollection =  $this->resource->merge($filtered);
        // return $mergedCollection;
        // unset($this->resource['data']);
        // $r = $this->resource->forget('data')->all();
        // return $this->resource['data'];
        // return ['data'=> $this->collection->makeVisible('book_number')];
        // return ['data'=> collect($this->collection)->except(['book_number'])->all()];
    }
}
