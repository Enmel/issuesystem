<?php
namespace App\Http\Controllers\Depositary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Modules\Depositary\ListDepositaryPackages;

class ListPendingPackages extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, ListDepositaryPackages $listDepositaryPackages)
    {
        return response()->json($listDepositaryPackages->handle(Auth::user()));
    }
}