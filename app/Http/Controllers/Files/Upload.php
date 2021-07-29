<?php
namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Http\Resources\File as ResourceFile;

class Upload extends Controller
{

    public function __invoke(Request $request)
    {
        try {
            
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $name = uniqid();
            $fullname = "{$name}.{$extension}";
            $path = env("FILE_PATH", "uploads/");

            $newFile = File::create([
                'name' => $fullname,
                'mime' => $file->getMimeType()
            ]);

            $file->move($path, $fullname);

            return response()->json(new ResourceFile($newFile));

        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
