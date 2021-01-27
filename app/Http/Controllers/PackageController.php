<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Packages;
use App\Http\Resources\Package as PackageResource;
use App\Http\Resources\ChargedToday as ChargedTodayResource;
use App\Models\PackageNotes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class PackageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function toDeliverToday(Request $request) : Response {

        $user = Auth::user();

        try {
            $packages = Packages::where('UserName', $user->UserName)
                        ->whereNotIn('Status', ['E', 'R', 'SA'])
                        ->whereDate('DeliveryDate', '>=', Carbon::today())
                        ->get();
            return response()->json(PackageResource::collection($packages));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
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

        $packageNotes = $request->only(['status', 'note', 'date']);
        
        try {
            $package = Packages::where('PackageID', $id)
                        ->firstOrFail();

            if($packageNotes['status'] === "E"){
                DB::table('Packages')
                        ->where('PackageID', $id)
                        ->update(['Status' => $packageNotes['status'], 'DeliveryDate' => Carbon::now()]);
            }else{

                $update = ['Status' => $packageNotes['status']];
                
                if($packageNotes['date']){
                    $update['DeliveryDate'] = $packageNotes['date'];
                }

                DB::table('Packages')
                        ->where('PackageID', $id)
                        ->update($update);
            }
            
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

    public function chargedToday(Request $request): Response {

        $user = Auth::user();

        try {
            $packages = Packages::where('UserName', $user->UserName)
                        ->whereIn('Status', ['E'])
                        ->whereDate('DeliveryDate', '=', Carbon::now())
                        ->get();
            return response()->json(new ChargedTodayResource(PackageResource::collection($packages)));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function personalOrder(Request $request): Response {
        
        $user = Auth::user();
        
        $orders = $request->input('packages');

        try {

            DB::beginTransaction();
            foreach ($orders as $order) {
                $package = Packages::where('PackageID', $order['id'])->firstOrFail();
                $package->update(['Organize' => $order['order']]);
            }
            DB::commit();
            return response()->json();
        } catch (ModelNotFoundException $e){
            DB::rollBack();
            return response()->json(['error' => 'Id de paquete no encontrado'], 400);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}