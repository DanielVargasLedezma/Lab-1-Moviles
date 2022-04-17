<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
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
            'cedula_usuario' => $this->cedula_usuario,
            'tipo_usuario' => $this->tipo_usuario,
            'nombre' => $this->nombre,
            'estado' => $this->estado,
        ];
    }
}
