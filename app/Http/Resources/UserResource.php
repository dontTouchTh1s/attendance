<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'first_name' => $this->employee->first_name,
            'last_name' => $this->employee->last_name,
            'group_policy' => $this->employee->groupPolicy->name,
            'roll' => $this->roll
        ];
    }
}
