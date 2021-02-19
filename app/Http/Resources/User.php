<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    public function toArray($request)
    {

        return [
            'accountID' => $this->AccountID,
            'username' => $this->UserName,
            'type' => [
                'name' => $this->Type->Name,
                'id' => $this->Type->TypeUsersID
            ],
            'role' => [
                'name' => $this->Role->Role->RoleName,
                'id' => $this->Role->Role->RoleID
            ],
            'photoUrl' => $this->PhotoUrl ?? "https://ui-avatars.com/api/?background=random&name={$this->UserName}",
            'isActive' => (bool) $this->isActive,
            'apiToken' => $this->apiToken,
        ];
    }
}