<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserObjectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->attendanceLeave->type,
            'date' => $this->attendanceLeave->date,
            'description' => $this->description,
            'reviewed' => $this->reviewed
        ];
    }
}
