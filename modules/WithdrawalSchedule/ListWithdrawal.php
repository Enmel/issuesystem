<?php
namespace Modules\WithdrawalSchedule;

use App\Models\User;
use App\Models\WithdrawalSchedule;
use App\Jobs\Job;
use App\Http\Resources\WithdrawalSchedule\Schedule;

class ListWithdrawal extends Job
{

    public function __construct()
    {
    }

    public function handle(User $user)
    {
        return Schedule::collection(WithdrawalSchedule::waitingCollector($user->UserName)->get());
    }
}