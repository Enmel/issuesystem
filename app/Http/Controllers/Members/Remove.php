<?php
namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

use Illuminate\Database\Eloquent\ModelNotFoundException;  

class Remove extends Controller
{

    public function __invoke(Request $request, int $groupID, int $userID)
    {
        try {
            Member::where([
                'group_id' => $groupID,
                'user_id' => $userID
            ])->firstOrFail()->delete();

            return response()->json([]);
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'El miembro que desea borrar o el grupo no existen'], 400);
        }
    }
}
