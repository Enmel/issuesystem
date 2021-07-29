<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GenericComment extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'note' => $this->note,
            'owner' => new User($this->ownerData),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}