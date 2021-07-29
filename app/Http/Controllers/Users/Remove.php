<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User as ResourceUser;

use Illuminate\Database\Eloquent\ModelNotFoundException;  

class Remove extends Controller
{

    public function __invoke(Request $request, int $id)
    {
        try {
            $user = User::where('id', $id)->firstOrFail();
            $user->delete();
            return response()->json();
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Usuario no existe'], 400);
        }
    }
}
