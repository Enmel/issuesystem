<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User as ResourceUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;  

class Update extends Controller
{

    public function __invoke(Request $request, int $id)
    {
        try {
            
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;

            if($request->password !== 'default'){
                $user->password = md5($request->password);
            }

            $user->token = md5(time()."{$request->email}{$request->password}");
            $user->save();

            return response()->json(new ResourceUser($user));
        } catch (ModelNotFoundException $e){
            return response()->json(['error' => 'Usuario y clave no coinciden'], 400);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
