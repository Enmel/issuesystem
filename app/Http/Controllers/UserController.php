<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use App\Models\User;
use App\Http\Resources\User as ResourceUser;

use Illuminate\Database\Eloquent\ModelNotFoundException;  

class UserController extends Controller
{

    public function login(Request $request) : Response {

        try {
            $user = User::where('UserName', $request->username)
                        ->where('UserPassword',md5($request->password))
                        ->firstOrFail();
            return response()->json(new ResourceUser($user));
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Usuario y clave no coinciden'], 400);
        }
    }
}