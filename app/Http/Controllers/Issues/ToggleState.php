<?php
namespace App\Http\Controllers\Issues;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Issue;
use App\Http\Resources\Issue as ResourceIssue;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class ToggleState extends Controller
{

    public function __invoke(Request $request, int $issueID)
    {
        try {
            
            $issue = Issue::findOrFail($issueID);
            $issue->status = $issue->status === "OPEN" ? "CLOSED" : "OPEN";
            $issue->save();

            return response()->json();
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Incidente no encontrado'], 400);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
