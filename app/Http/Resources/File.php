<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class File extends JsonResource
{
    public function toArray($request)
    {
        $path = env("FILE_PATH", "uploads/");
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mime' => $this->mime,
            'url' => url($path.$this->name)
        ];
    }
}