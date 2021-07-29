<?php
namespace App\Http\Controllers\Errors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Error;
use App\Http\Resources\Error as ResourceError;

class ListErrors extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        try {
            $errors = Error::with('project')->get();
            return response()->json(ResourceError::collection($errors));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
