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

        $deliveryInfo = [
            'address' => $this->DeliveryAddress,
            'deliveryDate' => $this->DeliveryDate
        ];

        if($this->Destination) {

            $destination = $this->Destination->toArray();
            $deliveryInfo = [
                'deliveryDate' => $this->DeliveryDate,
                'department' => [
                    'name' => $destination['township']['department']['Name'],
                    'code' => $destination['township']['department']['Code'],
                ],
                'township' => [
                    'name' => $destination['township']['Name'],
                    'code' => $destination['township']['Code'],
                ],
                'destination' => [
                    'name' => $destination['Name'],
                    'code' => $destination['Code']
                ],
                'address' => $this->DeliveryAddress,
                'observations' => $this->Observations
            ];
        }

        return [
            'id' => $this->PackageID,
            'guideNumber' => $this->GuideNumber,
            'description' => $this->Description,
            'size' => $this->Size,
            'weight' => $this->Weight,
            'client' => new ClientResource($this->Client),
            'receptor' => $this->ReceiverName,
            'receptorPhone' => [
                'phoneNumber1' => $this->PhoneNumber,
                'phoneNumber2' => $this->PhoneNumber2
            ],
            'order' => $this->Organize,
            'price' => $this->Price,
            'deliveryInfo' => $deliveryInfo,
            'status' => new StatusResource($this->StatusData),
            'notes' => NotesResource::collection($this->Notes),
            'auditDate' => $this->AuditDate,
            'deliveryman' => $this->UserName
        ];
    }
}
