<?php
namespace App\Http\Controllers\PanelCollector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Modules\PanelCollector\ListPanelCollectorPackages;

class ListPendingPackages extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, ListPanelCollectorPackages $listPanelCollectorPackages)
    {
        return response()->json($listPanelCollectorPackages->handle(Auth::user()));
    }
}