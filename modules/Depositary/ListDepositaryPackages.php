<?php
namespace Modules\Depositary;

use App\Models\User;
use App\Models\Packages;
use App\Jobs\Job;
use Illuminate\Support\Facades\DB;

class ListDepositaryPackages extends Job
{

    public function __construct()
    {
    }

    public function handle(User $user)
    {
        $clientList = DB::table('WithdrawalSchedule')->where('UserName', $user->UserName)->pluck('ClientID');
        return Packages::whereIn('Status', ['SA', 'PRR'])->whereIn('clientID', $clientList->values())->get();
    }
}