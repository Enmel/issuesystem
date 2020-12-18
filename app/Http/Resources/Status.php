<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Status extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->StatusID,
            'name' => $this->Name,
            'description' => $this->Description,
        ];
    }
}