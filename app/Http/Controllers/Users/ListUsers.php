<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User as ResourceUser;

use Illuminate\Database\Eloquent\ModelNotFoundException;  

class ListUsers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        try {
            $result = User::where('email', 'LIKE', '%' . $request->get('email', "") . '%')->get();
            $result2 = User::where('name', 'LIKE', '%' . $request->get('email', "") . '%')->get();
            $result = $result->merge($result2);
            return response()->json($result);
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Usuario y clave no coinciden'], 400);
        }
    }
}
