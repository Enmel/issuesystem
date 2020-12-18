<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageNotes extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->PackageNoteID,
            'status' => $this->NewStatus,
            'note' => $this->Note,
            'create_at' => $this->LogDate,
            'packageId' => $this->PackageID
        ];
    }
}