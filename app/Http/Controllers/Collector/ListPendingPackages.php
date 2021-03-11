<?php
namespace App\Http\Controllers\Collector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Modules\Collector\ListCollectorPackages;

class ListPendingPackages extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, ListCollectorPackages $listCollectorPackages)
    {
        return response()->json($listCollectorPackages->handle(Auth::user()));
    }
}