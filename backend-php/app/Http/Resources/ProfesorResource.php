<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfesorResource extends JsonResource
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
            'cedula_profesor' => $this->cedula_profesor,
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'correo' => $this->correoe,
        ];
    }
}
