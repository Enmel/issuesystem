<?php
namespace Modules\Collector;

use App\Models\User;
use App\Models\Packages;
use App\Models\WithdrawalSchedule;
use App\Jobs\Job;
use Illuminate\Support\Facades\DB;
use Modules\WithdrawalSchedule\ListWithdrawal;
use App\Http\Resources\WithdrawalSchedule\ScheduleWithPackages;

class ListCollectorPackages extends Job
{

    public function __construct(ListWithdrawal $listWithdrawal)
    {
        $this->listWithdrawal = $listWithdrawal;
    }

    public function handle(User $user)
    {
        $userWithdrawal = WithdrawalSchedule::waitingCollector($user->UserName)->get();
        $clientList = $userWithdrawal->pluck('ClientID');
        $packages = Packages::whereIn('Status', ['SA', 'PRR'])->whereIn('clientID', $clientList->values())->get()->groupBy('ClientID');
        ScheduleWithPackages::using(['packages' => $packages]);
        return ScheduleWithPackages::collection($userWithdrawal);
    }
}