<?php
namespace App\Http\Controllers\Errors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Error;
use App\Http\Resources\Error as ResourceError;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class ToggleState extends Controller
{

    public function __invoke(Request $request, int $errorID)
    {
        try {
            
            $error = Error::findOrFail($errorID);
            $error->status = $error->status === "Pending" ? "Resolved" : "Pending";
            $error->save();

            return response()->json();
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Error no encontrado'], 400);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
