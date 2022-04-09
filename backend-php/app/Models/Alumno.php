<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Alumno extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'alumnos';

    protected $primaryKey = 'cedula_alumno';

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cedula_alumno',
        'nombre',
        'telefono',
        'correoE',
        'fecha_nacimiento',
        'codigo_carrera',
        'contraseña',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'contraseña',
    ];

    // public function cursos()
    // {
    //     return $this->hasMany(Telefono::class, 'id_corresp', 'id_usuario');
    // }
}
