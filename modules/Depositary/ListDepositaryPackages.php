<?php
namespace Modules\Depositary;

use App\Models\User;
use App\Models\Packages;
use App\Models\WithdrawalSchedule;
use App\Jobs\Job;
use App\Http\Resources\Package as PackageResource;
use App\Http\Resources\Depositary\PackageList;
use Illuminate\Support\Facades\DB;

class ListDepositaryPackages extends Job
{

    public function __construct()
    {
    }

    public function handle(User $user)
    {
        $packages = Packages::where('Status', 'ER')->get();
        $clients = $packages->pluck('ClientID')->unique();
        $packagesByClient = $packages->groupBy('ClientID');
        $withdrawalSchedule = WithdrawalSchedule::where('Status', 'W-R')->whereIn('ClientID', $clients)->get()->groupBy('ClientID');

        $cosas = [];

        foreach ($packagesByClient as $key => $item) {
            
            $lastWithdrawal = collect($withdrawalSchedule->get($key))->last();

            if(empty($lastWithdrawal)){
                continue;
            }

            $collector = $lastWithdrawal->UserName;

            $cosas[] = [
                'collector' => $collector,
                'packages' => PackageResource::collection($item),
            ];
        }
        
        return $cosas;
    }
}