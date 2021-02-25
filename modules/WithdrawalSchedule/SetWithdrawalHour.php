<?php
namespace Modules\WithdrawalSchedule;

use App\Models\User;
use App\Models\WithdrawalSchedule;
use App\Jobs\Job;
use App\Http\Resources\WithdrawalSchedule\Schedule;

class SetWithdrawalHour extends Job
{

    public function __construct()
    {
    }

    public function handle(WithdrawalSchedule $withdrawalSchedule, Time $time)
    {
        return $withdrawalSchedule->update(['TimeWithdrawal' => $time->value]);
    }
}