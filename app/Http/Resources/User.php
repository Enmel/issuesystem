<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    public function toArray($request)
    {
        return [

            'token' => $this->token,
            'user' => [
                'name' => $this->name,
                'email' => $this->email,
                'picture_url' => $this->picture_url ?? "https://ui-avatars.com/api/?background=random&name={$this->UserName}",
                'role' => $this->role
            ],
            'logged' => true
        ];
    }
}