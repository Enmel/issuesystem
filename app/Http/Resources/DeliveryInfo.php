<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryInfo extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->ClientID,
            'company' => $this->CompanyName,
            'name' => $this->DirectContact,
            'phoneBusiness' => $this->BusinessPhone,
            'phone' => $this->PhoneNumberDirect,
            'address' => $this->Address,
            'job' => $this->TypeActivity,
            'description' => $this->Description,
            'auditDate' => $this->AuditDate
        ];
    }
}