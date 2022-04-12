<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CicloResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_ciclo' => $this->id_ciclo,
            'numero_ciclo' => $this->numero_ciclo,
            'year' => $this->year,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_finalizacion' => $this->fecha_finalizacion,
            'ciclo_activo' => $this->ciclo_activo,
        ];
    }
}
