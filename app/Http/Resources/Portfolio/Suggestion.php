<?php

namespace App\Http\Resources\Depositary;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Client as ClientResource;
use Illuminate\Support\Facades\DB;

class PackageList extends JsonResource
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
            'username' => $this->UserName,
            'withdrawal' => [
                'date' => $this->DateWithdrawal,
                'hour' => $this->TimeWithdrawal
            ],
            //'packages' => Package::collection(static::$using['packages'][$this->client->ClientID] ?? [])
        ];
    }
}
