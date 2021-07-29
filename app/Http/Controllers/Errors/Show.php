<?php
namespace App\Http\Controllers\Errors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Error as ResourceError;
use App\Models\Error;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class Show extends Controller
{

    public function __invoke(Request $request, int $errorID)
    {
        try {

            $errors = Error::where('id', $errorID)->with('project')->firstOrFail();
            return response()->json(new ResourceError($errors));
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Error no encontrada'], 400);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
