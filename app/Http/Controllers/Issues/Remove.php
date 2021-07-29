<?php
namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Resources\Group as ResourceGroup;

use Illuminate\Database\Eloquent\ModelNotFoundException;  

class Remove extends Controller
{

    public function __invoke(Request $request, int $id)
    {
        try {
            $group = Group::where('id', $id)->firstOrFail();
            $group->delete();
            return response()->json();
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Usuario no existe'], 400);
        }
    }
}
