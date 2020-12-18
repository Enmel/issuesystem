<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Packages;
use App\Http\Resources\Package as PackageResource;
use App\Models\PackageNotes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class PackageController extends Controller
{

    public function toDeliverToday(Request $request) : Response {

        $user = Auth::user();

        try {
            $packages = Packages::where('UserName', $user->UserName)
                        ->whereDate('AuditDate', '>=', Carbon::now())
                        ->get();
            return response()->json(PackageResource::collection($packages));
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Usuario y clave no coinciden'], 400);
        }
    }

    public function findByID(Request $request, int $id) : Response {

        try {
            $package = Packages::where('PackageID', $id)
                        ->firstOrFail();
            return response()->json(new PackageResource($package));
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Id de paquete no encontrado'], 400);
        }
    }

    public function editPackage(Request $request, int $id) : Response {

        $packageNotes = $request->only(['status', 'note']);
        
        try {
            $package = Packages::where('PackageID', $id)
                        ->firstOrFail();

            DB::table('Packages')
                        ->where('PackageID', $id)
                        ->update(['Status' => $packageNotes['status']]);
            
            PackageNotes::create([
                'NewStatus' => $packageNotes['status'],
                'Note' => $packageNotes['note'],
                'LogDate' => Carbon::now()->toDateString(),
                'PackageID' => $id,
            ]);

            return response()->json(new PackageResource($package));
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Id de paquete no encontrado'], 400);
        }
    }
}