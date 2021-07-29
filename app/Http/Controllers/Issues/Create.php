<?php
namespace App\Http\Controllers\Issues;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Issue;
use App\Http\Resources\Issue as ResourceIssue;
use App\Models\IssueComment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Create extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        try {

            $user = Auth::user();

            $issue = Issue::create([
                'title' => $request->title,
                'error_code' => null,
                'group' => $request->group,
                'contact' => null,
                'reporter' => $user->id,
                'spotted_at' => Carbon::now()
            ]);

            IssueComment::create([
                'note' => $request->comment,
                'owner' => $user->id,
                'issue' => $issue->id
            ]);

            return response()->json(new ResourceIssue($issue));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
