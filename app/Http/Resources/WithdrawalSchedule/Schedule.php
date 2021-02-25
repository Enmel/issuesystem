<?php

namespace App\Http\Resources\WithdrawalSchedule;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Client as ClientResource;

class Schedule extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->WithdrawalScheduleID,
            'username' => $this->UserName,
            'withdrawal' => [
                'date' => $this->DateWithdrawal,
                'hour' => $this->TimeWithdrawal
            ],
            'client' => new ClientResource($this->client)
        ];
    }
}
