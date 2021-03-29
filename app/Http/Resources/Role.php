<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Role extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->Role->RoleID,
            'name' => $this->Role->RoleName,
            'isActive' => (bool) $this->IsActive,
        ];
    }
}