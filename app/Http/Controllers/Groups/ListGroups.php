<?php
namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Resources\Group as ResourceGroups;

class ListGroups extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        try {
            $result = Group::where('name', 'LIKE', '%' . $request->get('text', "") . '%')->with('file')->get();
            $result2 = Group::where('description', 'LIKE', '%' . $request->get('text', "") . '%')->with('file')->get();
            $result = $result->merge($result2);
            return response()->json(ResourceGroups::collection($result));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
