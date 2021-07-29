<?php
namespace App\Http\Controllers\IssuesComment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IssueComment;
use App\Models\Issue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;  


class Create extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, int $issueID)
    {
        try {

            $user = Auth::user();
            Issue::findOrFail($issueID);

            IssueComment::create([
                'note' => $request->note,
                'issue' => $issueID,
                'owner' => $user->id
            ]);

            return response()->json();
        } catch (ModelNotFoundException){
            return response()->json(['error' => "Issue no encontrado"], 404);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
