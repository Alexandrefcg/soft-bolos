<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CakeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'weight' => $this->weight,
            'value' => $this->value,
            'quantity' => $this->quantity,
            'interested_emails' => $this->interestedEmails,
        ];
    }
}
