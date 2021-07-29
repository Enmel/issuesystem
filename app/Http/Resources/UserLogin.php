<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLogin extends JsonResource
{
    public function toArray($request)
    {
        return [
            'token' => $this->token,
            'user' => [
                'name' => $this->name,
                'email' => $this->email,
                'picture' => $this->picture ?? "http://localhost/issuesystem/public/avatar?name={$this->name}",
                'role' => $this->role
            ],
            'logged' => true
        ];
    }
}