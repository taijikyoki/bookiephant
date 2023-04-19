<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'author'=> $this->author,
            'genres'=> array_column($this->genres, 'value'),
            'year'  => $this->release_year,
            'type'  => $this->publishing_type,
        ];
    }
}
