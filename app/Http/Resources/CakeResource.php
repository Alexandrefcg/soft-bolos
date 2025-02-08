<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name
 * @property float $weight
 * @property float $value
 * @property int $quantity
 * @property \Illuminate\Database\Eloquent\Collection $interestedEmails
 */
class CakeResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray($request): array
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
