<?php
namespace App\Http\Controllers\WithdrawalSchedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\WithdrawalSchedule\ListWithdrawal;


class Show extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, ListWithdrawal $listWithdrawal)
    {
        return response()->json($listWithdrawal->handle(Auth::user()));
    }
}
