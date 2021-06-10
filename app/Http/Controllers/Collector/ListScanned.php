<?php
namespace App\Http\Controllers\Collector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Modules\Collector\ListCollectorScannedPackages as Command;

class ListScanned extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, Command $command)
    {
        return response()->json($command->handle(Auth::user()));
    }
}