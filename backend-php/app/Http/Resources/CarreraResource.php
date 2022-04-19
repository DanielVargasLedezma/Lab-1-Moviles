<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarreraResource extends JsonResource
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
            'codigo_carrera' => $this->codigo_carrera,
            'nombre' => $this->nombre,
            'titulo' => $this->titulo,
            'cursos' => CursoResource::collection($this->cursos),
        ];
    }
}
