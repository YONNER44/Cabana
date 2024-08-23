<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PqrResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'hechos' => $this->hechos,
            'pretensiones' => $this->pretensiones,
            'tipo_suge' => $this->tipo_suge,
            'estado' => $this->estado,
            'created_at'=>$this->created_at->toDateTimeString(),
            'updated_at'=>$this->updated_at->toDateTimeString(),
            'user_id' => $this->user_id,
            'usuario'=>new UserResource($this->whenLoaded('user')),
        ];
    }
}
