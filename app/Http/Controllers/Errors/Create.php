<?php
namespace App\Http\Controllers\Errors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Error;
use App\Http\Resources\Error as ResourceError;
use App\Models\ErrorComment;
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

            $error = Error::create([
                'title' => $request->title,
                'group' => $request->group,
                'type' => $request->type,
            ]);

            ErrorComment::create([
                'note' => $request->comment,
                'user' => $user->id,
                'error' => $error->id
            ]);

            return response()->json(new ResourceError($error));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
