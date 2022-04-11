<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlumnoResource extends JsonResource
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
            'cedula_alumno' => $this->cedula_alumno,
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'correo' => $this->correoe,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'carrera' => $this->carrera,
        ];
    }
}
