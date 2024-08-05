<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
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
            'name' => $this->project_title,
            'type' => $this->type,
            'description' => $this->description,
            'start' => $this->start,
            'end' => $this->end,
            'client' => $this->client,
            'tech' => json_decode($this->technologies),
            'images' => collect(json_decode($this->images))->map( fn($item) => asset($item) ),
            'modules' => json_decode($this->modules),
            'demo' => json_decode($this->demo),
        ];
    }
}
