<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CursoResource extends JsonResource
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
            'codigo_curso' => $this->codigo_curso,
            'nombre' => $this->nombre,
            'creditos' => $this->creditos,
            'horas_semanales' => $this->horas_semanales,
            'num_semestre_a_llevar' => $this->num_semestre_a_llevar,
            'anyo_a_llevar' => $this->anyo_a_llevar,
            'carrera' => $this->carrera,
        ];
    }
}
