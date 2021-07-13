<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User as ResourceUser;

class Create extends Controller
{

    public function __invoke(Request $request)
    {
        try {
            
            $user = User::create([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'picture_url' => $request->picture_url ?? '',
                'password' => md5($request->password),
                'token' => md5(time()."{$request->email}{$request->password}")
            ]);

            return response()->json(new ResourceUser($user));
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
