<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Packages;
use App\Http\Resources\Package as PackageResource;

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
            return response()->json($package);
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Id de paquete no encontrado'], 400);
        }
    }

    public function editPackage(Request $request, int $id) : Response {

        try {
            $user = User::where('UserName', $request->username)
                        ->where('UserPassword',md5($request->password))
                        ->firstOrFail();
            return response()->json($user);
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Usuario y clave no coinciden'], 400);
        }
    }
}