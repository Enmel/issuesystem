<?php

namespace App\Http\Resources\WithdrawalSchedule;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Client as ClientResource;
use App\Http\Resources\Package;

class ScheduleWithPackages extends JsonResource
{
    private $packages;

    protected static $using = [];

    public static function using($using = [])
    {
        static::$using = $using;
    }

    public function toArray($request)
    {
        return [
            'id' => $this->WithdrawalScheduleID,
            'username' => $this->UserName,
            'withdrawal' => [
                'date' => $this->DateWithdrawal,
                'hour' => $this->TimeWithdrawal
            ],
            'client' => new ClientResource($this->client),
            'packages' => Package::collection(static::$using['packages'][$this->client->ClientID] ?? [])
        ];
    }
}
