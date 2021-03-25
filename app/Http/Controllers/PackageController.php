<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Packages;
use App\Models\WithdrawalSchedule;
use App\Http\Resources\Package as PackageResource;
use App\Http\Resources\ChargedToday as ChargedTodayResource;
use App\Models\PackageNotes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use phpDocumentor\Reflection\Types\Null_;

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
                        ->whereNotIn('Status', ['E', 'R', 'SA', 'EB', 'ER', 'ER2'])
                        ->whereDate('DeliveryDate', '>=', Carbon::today())
                        ->get();
            return response()->json(PackageResource::collection($packages));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function listPackages(Request $request) : Response {

        $user = Auth::user();
        $status = $request->input('status');
        $clientID = $request->input('clientID');

        try {

            $packages = Packages::all()
                        ->when($status, function ($query, $status) {
                            return $query->where('Status', $status);
                        })
                        ->when($clientID, function ($query, $status) {
                            return $query->where('ClientID', $status);
                        });
            return response()->json(PackageResource::collection($packages));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function listPackagesRecolector(Request $request) : Response {

        $clientID = $request->input('clientID', 0);

        try {

            $packages = Packages::whereIn('Status', ['SA', 'PRR'])->where('clientID', $clientID)->get();
            return response()->json(PackageResource::collection($packages));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function rejected(Request $request) : Response {

        $user = Auth::user();

        try {
            $packages = Packages::where('UserName', $user->UserName)
                        ->whereIn('Status', ['R'])
                        ->get();
            return response()->json(PackageResource::collection($packages));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function findByID(Request $request, string $id) : Response {

        try {
            $package = Packages::where('GuideNumber', $id)
                        ->firstOrFail();
            return response()->json(new PackageResource($package));
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Id de paquete no encontrado'], 400);
        }
    }

    public function editPackage(Request $request, string $id) : Response {

        $user = Auth::user();
        $packageNotes = $request->only(['status', 'note', 'date']);
        
        try {
            $package = Packages::where('GuideNumber', $id)
                        ->firstOrFail();

            $id = $package->PackageID;
            $oldStatus = $package->Status;

            if($packageNotes['status'] === "E"){
                DB::table('Packages')
                        ->where('PackageID', $id)
                        ->update(['Status' => $packageNotes['status'], 'DeliveryDate' => Carbon::now()]);
            }elseif($packageNotes['status'] === "ER" && $oldStatus === "IO1"){

                DB::table('Packages')
                        ->where('PackageID', $id)
                        ->update(['Status' => $packageNotes['status'], 'UserName' => NULL]);

            }elseif($packageNotes['status'] === "ER"){
                

                $WithdrawalSchedule = WithdrawalSchedule::where('ClientID', $package->ClientID)->where('Status', 'W-P')->get();
                
                $packages = Packages::where(['ClientID' => $package->ClientID, 'UserName' => $package->UserName])
                ->whereIn('Status', ['SA', 'PRR']);

                if((!$WithdrawalSchedule->isEmpty()) && $packages->count() <= 1){
                    $WithdrawalSchedule = $WithdrawalSchedule->first();
                    $WithdrawalSchedule->Status = 'W-R';
                    $WithdrawalSchedule->save();
                }

                DB::table('Packages')
                        ->where('PackageID', $id)
                        ->update(['Status' => $packageNotes['status']]);

            }elseif($packageNotes['status'] === 'EB' && $oldStatus === "IO1"){
        
                DB::table('Packages')
                        ->where('PackageID', $id)
                        ->update(['Status' => $packageNotes['status'], 'UserName' => NULL]);

            }elseif($packageNotes['status'] === 'EB'){
        
                $WithdrawalSchedule = WithdrawalSchedule::where('ClientID', $package->ClientID)->where('Status', 'W-R')->get();
                
                $packages = Packages::where(['ClientID' => $package->ClientID, 'UserName' => $package->UserName])
                ->where('Status', 'ER');

                if((!$WithdrawalSchedule->isEmpty()) && $packages->count() <= 1){
                    $WithdrawalSchedule = $WithdrawalSchedule->first();
                    $WithdrawalSchedule->Status = 'W-C';
                    $WithdrawalSchedule->save();
                }

                DB::table('Packages')
                        ->where('PackageID', $id)
                        ->update(['Status' => $packageNotes['status']]);

            }elseif($packageNotes['status'] === 'ER2'){
                DB::table('Packages')
                        ->where('PackageID', $id)
                        ->update(['Status' => $packageNotes['status']]);

            }elseif($packageNotes['status'] === 'I01'){
                DB::table('Packages')
                        ->where('PackageID', $id)
                        ->update(['Status' => $packageNotes['status'], 'UserName' => $user->UserName, 'DeliveryDate' => $packageNotes['date']]);
            }elseif($packageNotes['status'] === 'BACK'){

                $lastNote = $package->Notes->last();
                $packageNotes['status'] = $lastNote->NewStatus;

                DB::table('Packages')
                        ->where('PackageID', $id)
                        ->update(['Status' => $packageNotes['status'], 'UserName' => $user->UserName]);
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
                'Executor' => $user->UserName,
                'NewStatus' => $packageNotes['status'],
                'OldStatus' => $oldStatus,
                'Note' => $packageNotes['note'] ?? '',
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