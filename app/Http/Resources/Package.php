<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Status as StatusResource;
use App\Http\Resources\PackageNotes as NotesResource;
use App\Http\Resources\Client as ClientResource;
use App\Http\Resources\Destination as DestinationResource;

class Package extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->PackageID,
            'guideNumber' => $this->GuideNumber,
            'description' => $this->Description,
            'size' => $this->Size,
            'weight' => $this->Weight,
            'client' => new ClientResource($this->Client),
            'order' => $this->Organize,
            'price' => $this->Price,
            'deliveryInfo' => [
                'address' => $this->DeliveryAddress,
            ],
            'status' => new StatusResource($this->StatusData),
            'notes' => NotesResource::collection($this->Notes),
            'auditDate' => $this->AuditDate,
            'deliveryman' => $this->UserName
        ];
    }
}