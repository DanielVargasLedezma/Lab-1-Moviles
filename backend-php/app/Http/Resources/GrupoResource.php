<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GrupoResource extends JsonResource
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
            'numero_grupo' => $this->numero_grupo,
            'curso' => $this->curso,
            'profesor' => $this->profesor,
            'ciclo' => $this->ciclo,
            'horario' => $this->horario,
            'dia_uno' => $this->dia_uno,
            'dia_dos' => $this->dia_dos,
        ];
    }
}
