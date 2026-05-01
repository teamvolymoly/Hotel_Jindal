<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactInquiryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'arrival_date' => optional($this->arrival_date)?->format('Y-m-d'),
            'departure_date' => optional($this->departure_date)?->format('Y-m-d'),
            'adults' => $this->adults,
            'children' => $this->children,
            'room_category' => $this->room_category,
            'message' => $this->message,
            'agreed_to_terms' => (bool) $this->agreed_to_terms,
            'created_at' => optional($this->created_at)?->toIso8601String(),
            'updated_at' => optional($this->updated_at)?->toIso8601String(),
        ];
    }
}
