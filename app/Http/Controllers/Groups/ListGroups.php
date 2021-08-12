<?php
namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Resources\Group as ResourceGroups;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class ListGroups extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        try {

            $user = Auth::user();
            $text = $request->get('text', "");

            if($user->isAdmin) {
                $result = Group::with('file')->get();
            }else{
                $result = $user->groups;
            }

            $result = $this->compareModel($result, $text);
            return response()->json(ResourceGroups::collection($result));

        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function compareModel($collection, $text = "") {

        $text = strtolower($text);

        return $collection->filter(function ($value) use ($text) {
            return str_contains(strtolower($value->name), $text) || str_contains(strtolower($value->description), $text);
        });
    }
}
