<?php
namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Resources\User as ResourceUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class ListMembers extends Controller
{

    public function __invoke(Request $request, int $groupID)
    {
        try {

            $group = Group::findOrFail($groupID);
            $members = $group->members;
            return response()->json(ResourceUser::collection($members->pluck('user')));
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Grupo no encontrado'], 400);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
