<?php
namespace Modules\PanelCollector;

use App\Models\User;
use App\Models\Packages;
use App\Models\WithdrawalSchedule;
use App\Jobs\Job;
use App\Http\Resources\Package as PackageResource;
use App\Http\Resources\Depositary\PackageList;
use Illuminate\Support\Facades\DB;

class ListPanelCollectorPackages extends Job
{

    public function __construct()
    {
    }

    public function handle(User $user)
    {
        $packages = Packages::whereIn('Status', ['EB', 'ER2'])->with('Destination')->get();
        $packagesGroupedByDepartment = $packages->groupBy('destination.township.department.DepartmentID');

        $deparmentsIDs = collect($user->Destination)->pluck("destination.township.department.DepartmentID")->unique()->all();

        $result = [];

        foreach ($packagesGroupedByDepartment as $deparmentID => $item) {

            if(!in_array($deparmentID, $deparmentsIDs)){
                continue;
            }

            $result[] = [
                'department' => [
                    'id' => $deparmentID,
                    'name' => $item[0]['destination']['township']['department']['Name'],
                    'code' => $item[0]['destination']['township']['department']['Code']
                ],
                'packages' => PackageResource::collection($item),
            ];
        }

        return $result;
    }
}