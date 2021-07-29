<?php
namespace App\Http\Controllers\Issues;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Issue;
use App\Http\Resources\Issue as ResourceIssue;

class ListIssues extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        try {
            $issues = Issue::with('owner')->with('project')->get();
            return response()->json(ResourceIssue::collection($issues));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
