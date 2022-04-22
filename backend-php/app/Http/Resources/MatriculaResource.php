<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatriculaResource extends JsonResource
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
            'numero_matricula' => $this->numero_matricula,
            'alumno' => new AlumnoResource($this->alumno),
            'grupo' => new GrupoResource($this->grupo),
            'nota' => $this->nota,
        ];
    }
}
