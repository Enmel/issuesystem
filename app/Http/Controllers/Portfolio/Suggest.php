<?php
namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Portfolio\Suggest as SuggestCommand;
use Modules\Portfolio\SuggestQueryParams as QueryParams;


class Suggest extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, SuggestCommand $suggestCommand)
    {

        $queryParams = new QueryParams(
            type: $request->input('type', 'DOG'),
            size: $request->input('size', 'MEDIANO'),
            age: $request->input('age', 'ADULTO'),
            weight: $request->input('weight', 'IDEAL'),
            needs: $request->input('needs', 'SIN NECESIDAD ESPECIFICA')
        );

        return response()->json($suggestCommand->handle(Auth::user(), $queryParams));
    }
}
