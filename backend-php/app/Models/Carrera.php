<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = 'carreras';

    protected $primaryKey = 'codigo_carrera';

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo_carrera',
        'nombre',
        'titulo'
    ];

    /**
     * The name of the "created at" column.
     *
     * @var string|null
     */
    const CREATED_AT = null;

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = null;

    public function cursos()
    {
        return $this->hasMany(Curso::class, 'codigo_carrera', 'codigo_carrera');
    }

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'codigo_carrera', 'codigo_carrera');
    }

    public function grupos()
    {
        return $this->hasManyThrough(Grupo::class, Curso::class, 'codigo_carrera', 'codigo_curso', 'codigo_carrera', 'codigo_curso');
    }
}
