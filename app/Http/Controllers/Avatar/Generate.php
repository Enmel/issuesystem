<?php
namespace App\Http\Controllers\Avatar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Error as ResourceError;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;

class Generate extends Controller
{

    public function __invoke(Request $request)
    {
        try {

            $avatar = new InitialAvatar();
            $image = $avatar->name($request->name)->generate();
            return response($image->stream('png', 100), 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
