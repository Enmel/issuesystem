<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ChargedToday extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'packages' => $this->collection,
            'charged' => $this->collection->sum('Price')
        ];
    }
}