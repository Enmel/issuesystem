<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'picture' => $this->picture ?? "https://ui-avatars.com/api/?background=random&name={$this->UserName}",
            'role' => $this->role
        ];
    }
}