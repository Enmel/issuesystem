<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Issue extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'error_code' => $this->error_code,
            'group' => new Group($this->project),
            'comments' => GenericComment::collection($this->comments),
            'contact' => $this->contact,
            'reporter' => new User($this->owner),
            'spotted_at' => $this->spotted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}