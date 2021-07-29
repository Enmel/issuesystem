<?php
namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Resources\Group as ResourceGroups;
use App\Models\Member;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class AddMembers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, $groupID)
    {
        try {
            $group = Group::findOrFail($groupID);
            
            $newMembers = $request->members;

            if(!is_array($newMembers)){
                return response()->json([
                    'error' => 'La propiedad member debe ser un arreglo'
                ], 400);
            }

            foreach ($newMembers as $newMemberID) {
                Member::firstOrCreate([
                    'group_id' => $group->id,
                    'user_id' => $newMemberID
                ]);
            }
            
            return response()->json([]);
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Grupo no encontrado'], 400);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
