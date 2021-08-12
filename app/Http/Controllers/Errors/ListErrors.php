<?php
namespace App\Http\Controllers\Errors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Error;
use App\Http\Resources\Error as ResourceError;
use Illuminate\Support\Facades\Auth;

class ListErrors extends Controller
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
                $result = Error::with('project')->get();
            }else{
                $result = $user->groupsErrors->flatMap(function ($item) {
                    return $item->errors;
                });
            }

            $result = $this->filterText($result, $text);

            return response()->json(ResourceError::collection($result));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function filterText($collection, $text = "") {

        $text = strtolower($text);

        return $collection->filter(function ($value) use ($text) {
            return str_contains(strtolower($value->title), $text);
        });
    }
}
