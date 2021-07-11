<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RacesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'race_id' => $this->id,
            'race_type' => $this->type.'Km',
            'ranking' => RunnersResource::collection($this->whenLoaded('runnersByAge'))
        ];
    }
}
