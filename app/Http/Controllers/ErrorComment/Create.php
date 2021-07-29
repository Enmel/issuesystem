<?php
namespace App\Http\Controllers\ErrorComment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ErrorComment;
use App\Models\Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class Create extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, int $errorID)
    {
        try {

            $user = Auth::user();
            Error::findOrFail($errorID);

            ErrorComment::create([
                'note' => $request->note,
                'error' => $errorID,
                'user' => $user->id
            ]);

            return response()->json();
        } catch (ModelNotFoundException){
            return response()->json(['error' => "Error no encontrado"], 404);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
