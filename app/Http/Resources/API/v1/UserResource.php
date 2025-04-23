<?php

namespace App\Http\Resources\API\v1;

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
            'id' => $this->id,
            'first_name' => explode(' ', $this->name)[0],
            'last_name' => explode(' ', $this->name)[1],
            'full_name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at?->format('d.m.Y'),
            'created_at' => $this->created_at->format('d.m.Y'),
            'updated_at' => $this->updated_at->format('d.m.Y'),
        ];
    }
}
