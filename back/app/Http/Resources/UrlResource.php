<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 * )
 */
class UrlResource extends JsonResource
{
    /*
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request = null)
    {
         return [
            'id' => $this->id,
            'destination' => $this->destination,
            'description' => $this->description,
            'shortdest' => $this->short_url,
            'slug' => $this->slug,
            'views' => $this->views,
            'state' => $this->state,
            'created_at' => optional($this->created_at)->toDateString(),
            'updated_at' => optional($this->updated_at)->toDateString(),
        ];
    }
}
