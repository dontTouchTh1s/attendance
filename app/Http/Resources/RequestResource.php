<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
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
            'name' => $this->employee->first_name . ' ' . $this->employee->last_name,
            'type' => $this->requestable->type,
            'status' => $this->status,
            'description' => $this->description,
            'createDate' => $this->created_at,
            'leaveFromDate' => $this->requestable->from_date,
            'leaveToDate' => $this->requestable->to_date
        ];
    }
}
