<?php
namespace App\Http\Controllers\WithdrawalSchedule;

use App\Http\Controllers\Controller;
use App\Models\WithdrawalSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\WithdrawalSchedule\SetWithdrawalHour;
use Modules\WithdrawalSchedule\Time;


class SetHour extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, string $withdrawalSchedule, SetWithdrawalHour $setWithdrawalHour)
    {
        $withdrawalSchedule = WithdrawalSchedule::findOrFail($withdrawalSchedule);
        $time = new Time($request->time);
        return response()->json($setWithdrawalHour->handle($withdrawalSchedule, $time));
    }
}