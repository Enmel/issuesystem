<?php
namespace App\Http\Controllers\Issues;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Issue as ResourceIssue;
use App\Models\Issue;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class Show extends Controller
{

    public function __invoke(Request $request, int $issueID)
    {
        try {

            $group = Issue::where('id', $issueID)->with('comments')->firstOrFail();
            return response()->json(new ResourceIssue($group));
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Incidencia no encontrada'], 400);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
