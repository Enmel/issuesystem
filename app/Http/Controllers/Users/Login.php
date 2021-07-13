<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User as ResourceUser;

use Illuminate\Database\Eloquent\ModelNotFoundException;  

class Login extends Controller
{

    public function __invoke(Request $request)
    {
        try {
            $user = User::where('email', $request->email)
                        ->where('password',md5($request->password))
                        ->firstOrFail();
            return response()->json(new ResourceUser($user));
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Usuario y clave no coinciden'], 400);
        }
    }
}
