<?php

namespace App\Http\Resources;

use App\Models\Race;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassificationByAgeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
       return [
         'race_id' => $this['raceId'],
         'race_type' => $this['raceType'],
         'age_range' => $this['age_range']
       ];
    }
}
