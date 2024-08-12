<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BiodataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'birthday' => $this->birthday,
            'title' => $this->title,
            'degree' => $this->degree,
            'summary' => $this->summary,
            'photo' => asset($this->photo),
            'photo2' => asset($this->photo2),
        ];
    }
}
