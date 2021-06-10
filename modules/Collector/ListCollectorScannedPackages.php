<?php
namespace Modules\Collector;

use App\Models\User;
use App\Models\Packages;
use App\Models\WithdrawalSchedule;
use App\Jobs\Job;
use Modules\WithdrawalSchedule\ListWithdrawal;
use App\Http\Resources\Package as PackageResource;
use App\Http\Resources\Depositary\PackageList;

class ListCollectorScannedPackages extends Job
{

    public function __construct(ListWithdrawal $listWithdrawal)
    {
        $this->listWithdrawal = $listWithdrawal;
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

            if($user->UserName !== $lastWithdrawal->UserName) {
                continue;
            }

            $packages = PackageResource::collection($item);

            $cosas[] = [
                'client' => $packages->first()->client,
                'packages_count' => count($packages),
                'packages' => $packages,
            ];
        }
        
        return $cosas;
    }
}