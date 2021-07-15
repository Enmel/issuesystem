<?php
namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Resources\Group as ResourceGroup;

class Create extends Controller
{

    public function __invoke(Request $request)
    {
        try {

            $group = Group::create([
                'name' => $request->name,
                'picture' => $request->picture ?? null,
                'description' => $request->description
            ]);

            return response()->json(new ResourceGroup($group));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
