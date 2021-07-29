<?php
namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Resources\Group as ResourceGroup;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class Show extends Controller
{

    public function __invoke(Request $request, int $id)
    {
        try {

            $group = Group::where('id', $id)->firstOrFail();
            return response()->json(new ResourceGroup($group));
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Grupo no encontrado'], 400);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
