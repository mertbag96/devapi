<?php

namespace App\Http\Resources\API\v1;

use Illuminate\Http\Request;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'slug' => $this->slug,
            'title' => $this->title,
            'image' => $this->image,
            'summary' => $this->summary,
            'content' => $this->content,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at?->format('d.m.Y'),
            'created_at' => $this->created_at->format('d.m.Y'),
            'updated_at' => $this->updated_at->format('d.m.Y'),
        ];
    }
}
