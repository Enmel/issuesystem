<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    public function toArray($request)
    {

        $deparments = collect($this->Destination)->pluck("destination.township.department.Name")->unique();

        return [
            'deparments' => $deparments,
            'accountID' => $this->AccountID,
            'username' => $this->UserName,
            'type' => [
                'name' => $this->Type->Name,
                'id' => $this->Type->TypeUsersID
            ],
            'roles' => Role::collection($this->Role),
            'photoUrl' => $this->PhotoUrl ?? "https://ui-avatars.com/api/?background=random&name={$this->UserName}",
            'isActive' => (bool) $this->isActive,
            'apiToken' => $this->apiToken,
        ];
    }
}