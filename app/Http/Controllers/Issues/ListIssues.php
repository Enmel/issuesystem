<?php
namespace App\Http\Controllers\Issues;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Issue;
use App\Http\Resources\Issue as ResourceIssue;
use Illuminate\Support\Facades\Auth;

class ListIssues extends Controller
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
                $result = Issue::with('owner')->with('project')->get();
            }else{
                $result = $user->groupsIssues->flatMap(function ($item) {
                    return $item->issues;
                });
            }

            $result = $this->filterText($result, $text);

            return response()->json(ResourceIssue::collection($result));
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
